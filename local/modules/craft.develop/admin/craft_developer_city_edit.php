<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Города");

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\DDD\City\Infrastructure\Entity\CityTable;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = Application::getInstance()->getContext()->getRequest();
$ID = $request->get('ID');
$cityModel = $ID ? CityTable::getById($ID)->fetchObject() : CityTable::createObject();

if($request->isPost())
{
	$postData = $request->getPostList()->toArray();
	foreach($postData as $name => $value)
	{
		try
		{
			$cityModel->set($name, $value);
		} catch(Exception $e)
		{
		}
	}


	$result = $cityModel->save();

	if(!$result->isSuccess())
	{
		\Bitrix\Main\Diag\Debug::dumpToFile($result->getErrorMessages());
	}

	$_GET['ID'] = $cityModel->getId();
	LocalRedirect($APPLICATION->GetCurPage() . "?" . http_build_query($_GET));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Город',
		"ICON"  => "iblock_section",
		"TITLE" => $cityModel->getName() ? 'Изменить: ' . $cityModel->getName() : 'Новый город',
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

$entity = CityTable::getEntity();


if($field = $entity->getField(CityTable::F_ACTIVE))
{
	$tabControl->AddCheckBoxField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		[CityTable::ACTIVE_Y, CityTable::ACTIVE_N],
		!$cityModel || $cityModel->getActive()
	);
}

if($field = $entity->getField(CityTable::F_IS_DEFAULT))
{
	$tabControl->AddCheckBoxField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		[CityTable::DEFAULT_Y, CityTable::DEFAULT_N],
		!$cityModel || $cityModel->getIsDefault()
	);
}

if($field = $entity->getField(CityTable::F_SORT))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$cityModel ? $cityModel->getSort() : 500
	);
}

if($field = $entity->getField(CityTable::F_NAME))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255, 'id' => $field->getName()],
		$cityModel ? $cityModel->getName() : null
	);
}

if($field = $entity->getField(CityTable::F_CODE))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255, 'id' => $field->getName()],
		$cityModel ? $cityModel->getCode() : null
	);
}


$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_LIST_CITY . "?lang=" . LANG,
]);

$tabControl->Show();

bxTransliterate();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>