<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Объект");

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\DDD\Objects\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = Application::getInstance()->getContext()->getRequest();
$ID = $request->get('ID');
$buildObjectModel = $ID ? BuildObjectTable::getById($ID)->fetchObject() : BuildObjectTable::createObject();

if($request->isPost())
{
	$postData = $request->getPostList()->toArray();
	foreach($postData as $name => $value)
	{
		try
		{
			$buildObjectModel->set($name, $value);
		} catch(Exception $e)
		{
		}
	}


	$files = $request->getFileList()->toArray();
	if($files)
	{
		foreach($files as $propertyCode => $fileData)
		{
			$fileId = CFile::SaveFile($fileData, '/craft/develop/objects/');
			if($fileId)
			{
				$buildObjectModel->set($propertyCode, $fileId);
			}
		}
	}

	$result = $buildObjectModel->save();

	if(!$result->isSuccess())
	{
		\Bitrix\Main\Diag\Debug::dumpToFile($result->getErrorMessages());
	}

	$_GET['ID'] = $buildObjectModel->getId();
	LocalRedirect($APPLICATION->GetCurPage() . "?" . http_build_query($_GET));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Застройщик',
		"ICON"  => "iblock_section",
		"TITLE" => $buildObjectModel ? 'Изменить: ' . $buildObjectModel->getName() : 'Новый застройщик',
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

$entity = BuildObjectTable::getEntity();

if($field = $entity->getField(BuildObjectTable::F_ACTIVE))
{
	$tabControl->AddCheckBoxField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		[BuildObjectTable::ACTIVE_Y, BuildObjectTable::ACTIVE_N],
		$buildObjectModel ? $buildObjectModel->getActive() : true
	);
}

if($field = $entity->getField(BuildObjectTable::F_NAME))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$buildObjectModel ? $buildObjectModel->getName() : null
	);
}

if($field = $entity->getField(BuildObjectTable::F_SORT))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$buildObjectModel ? $buildObjectModel->getSort() : 500
	);
}

if($field = $entity->getField(BuildObjectTable::F_DEVELOPER_ID))
{

	$developers = ["" => 'Выбрать застройщика'];
	$developersCollection = DeveloperTable::getList()->fetchCollection();
	foreach($developersCollection as $developer)
	{
		$developers[$developer->getId()] = $developer->getName();
	}

	$tabControl->AddDropDownField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		$developers,
		$buildObjectModel ? $buildObjectModel->getDeveloperId() : null
	);
}

if($field = $entity->getField(BuildObjectTable::F_PICTURE_ID))
{
	$tabControl->AddFileField(
		$field->getName(),
		$field->getTitle(),
		$buildObjectModel?->getPictureId()
	);
}

$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_LIST_OBJECTS . "?lang=" . LANG,
]);

$tabControl->Show();