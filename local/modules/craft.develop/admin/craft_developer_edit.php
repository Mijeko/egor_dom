<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Застройщики");

use Bitrix\Main\Loader;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Bitrix\Main\Application;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = Application::getInstance()->getContext()->getRequest();
$ID = $request->get('ID');
$developerModel = $ID ? DeveloperTable::getById($ID)->fetchObject() : null;

if($request->isPost())
{
	$postData = $request->getPostList()->toArray();
	try
	{
		foreach($postData as $name => $value)
		{
			$developerModel->set($name, $value);
		}
	} catch(Exception $e)
	{
	}


	$files = $request->getFileList()->toArray();
	if($files)
	{
		foreach($files as $propertyCode => $fileData)
		{
			$fileId = CFile::SaveFile($fileData, '/craft/develop/developers/');
			if($fileId)
			{
				$developerModel->set($propertyCode, $fileId);
			}
		}
	}

	$developerModel->save();

	$_GET['ID'] = $developerModel->getId();
	LocalRedirect($APPLICATION->GetCurPage() . "?" . http_build_query($_GET));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Застройщик',
		"ICON"  => "iblock_section",
		"TITLE" => $developerModel ? 'Изменить: ' . $developerModel->getName() : 'Новый застройщик',
	],
];


$tabControl = new CAdminForm('craftDeveloperEditTabControl', $aTabs);
$tabControl->BeginEpilogContent();
?>
<?=bitrix_sessid_post()?>
<?php
if($ID)
{
	?>
	<input type="hidden" name="ID" value=<?=$ID?>>
	<?php
}
$tabControl->EndEpilogContent();
$tabControl->Begin();

$tabControl->BeginNextFormTab();

$entity = DeveloperTable::getEntity();

if($field = $entity->getField(DeveloperTable::F_ACTIVE))
{
	$tabControl->AddCheckBoxField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		[DeveloperTable::ACTIVE_Y, DeveloperTable::ACTIVE_N],
		$developerModel ? $developerModel->getActive() : true
	);
}

if($field = $entity->getField(DeveloperTable::F_NAME))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$developerModel ? $developerModel->getName() : null
	);
}

if($field = $entity->getField(DeveloperTable::F_SORT))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$developerModel ? $developerModel->getSort() : 500
	);
}

if($field = $entity->getField(DeveloperTable::F_PICTURE_ID))
{
	$tabControl->AddFileField(
		$field->getName(),
		$field->getTitle(),
		$developerModel?->getPictureId()
	);
}


$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_LIST_DEVELOPERS . "?lang=" . LANG,
]);

$tabControl->Show();