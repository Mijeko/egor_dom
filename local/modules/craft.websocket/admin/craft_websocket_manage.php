<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Квартиры");

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;

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




$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_LIST_APARTMENTS . "?lang=" . LANG,
]);

$tabControl->Show();

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>