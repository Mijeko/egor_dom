<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Управление");

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

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Управление',
		"ICON"  => "iblock_section",
		"TITLE" => 'Управление',
	],
];


$tabControl = new CAdminForm('craftDeveloperEditTabControl', $aTabs);
$tabControl->BeginEpilogContent();
?>
<?=bitrix_sessid_post()?>
<?php
$tabControl->EndEpilogContent();
$tabControl->Begin();

$tabControl->BeginNextFormTab();


$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_WEBSOCKET_ADMIN_URL_MANAGER . "?lang=" . LANG,
]);

$tabControl->Show();

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>