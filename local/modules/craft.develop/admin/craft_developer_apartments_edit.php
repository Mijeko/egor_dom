<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Квартиры");

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\DDD\Apartment\Infrastructure\Entity\ApartmentTable;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = Application::getInstance()->getContext()->getRequest();
$ID = $request->get('ID');
$aparmentModel = $ID ? ApartmentTable::getById($ID)->fetchObject() : ApartmentTable::createObject();

if($request->isPost())
{
	$postData = $request->getPostList()->toArray();
	foreach($postData as $name => $value)
	{
		try
		{
			$aparmentModel->set($name, $value);
		} catch(Exception $e)
		{
		}
	}


	$result = $aparmentModel->save();

	if(!$result->isSuccess())
	{
		\Bitrix\Main\Diag\Debug::dumpToFile($result->getErrorMessages());
	}

	$_GET['ID'] = $aparmentModel->getId();
	LocalRedirect($APPLICATION->GetCurPage() . "?" . http_build_query($_GET));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Квартира',
		"ICON"  => "iblock_section",
		"TITLE" => $aparmentModel->getName() ? 'Изменить: ' . $aparmentModel->getName() : 'Новая квартира',
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

$entity = ApartmentTable::getEntity();

if($field = $entity->getField(ApartmentTable::F_BUILD_OBJECT_ID))
{
	$buildObjectCollection = \Craft\DDD\Objects\Infrastructure\Entity\BuildObjectTable::getList()->fetchCollection();
	$buildObjectList = [null => 'Выбрать объект недвижимости'];

	foreach($buildObjectCollection as $buildObject)
	{
		$buildObjectList[$buildObject->getId()] = $buildObject->getName();
	}

	$tabControl->AddDropDownField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		$buildObjectList,
		$aparmentModel ? $aparmentModel->getBuildObjectId() : null
	);
}

if($field = $entity->getField(ApartmentTable::F_ACTIVE))
{
	$tabControl->AddCheckBoxField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		[ApartmentTable::ACTIVE_Y, ApartmentTable::ACTIVE_N],
		$aparmentModel ? $aparmentModel->getActive() : true
	);
}

if($field = $entity->getField(ApartmentTable::F_SORT))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$aparmentModel ? $aparmentModel->getSort() : 500
	);
}

if($field = $entity->getField(ApartmentTable::F_NAME))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255, 'id' => $field->getName()],
		$aparmentModel ? $aparmentModel->getName() : null
	);
}

if($field = $entity->getField(ApartmentTable::F_CODE))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255, 'id' => $field->getName()],
		$aparmentModel ? $aparmentModel->getCode() : null
	);
}

if($field = $entity->getField(ApartmentTable::F_PRICE))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$aparmentModel ? $aparmentModel->getPrice() : 0
	);
}

if($field = $entity->getField(ApartmentTable::F_PLAN_IMAGE_ID))
{
	$tabControl->AddFileField(
		$field->getName(),
		$field->getTitle(),
		$aparmentModel?->getPlanImageId()
	);
}


$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_LIST_APARTMENTS . "?lang=" . LANG,
]);

$tabControl->Show();

bxTransliterate();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>