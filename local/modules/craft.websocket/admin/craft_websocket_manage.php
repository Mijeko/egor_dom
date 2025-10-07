<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Управление");

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	}
}

$request = Application::getInstance()->getContext()->getRequest();

if($request->isPost())
{
	if($request->getPost('runSocket') == 'Y')
	{
		$result = null;
		exec('php /var/www/dom.local/test/index.php start &', $result);
		Debug::dumpToFile($result);
	}
}

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

$tabControl->BeginCustomField('run', '');
?>
	<tr>
		<td>Запустить сокеты</td>
		<td>
			<input type="checkbox" name="runSocket" value="Y">
		</td>
	</tr>
<?php
$tabControl->EndCustomField('run');


$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_WEBSOCKET_ADMIN_URL_MANAGER . "?lang=" . LANG,
]);

$tabControl->Show();

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>