<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/iblock/prolog.php');

/**
 * @global CMain $APPLICATION
 * @global CAdminSidePanelHelper $adminSidePanelHelper
 */
global $APPLICATION, $adminSidePanelHelper;
$APPLICATION->SetTitle("Импорт");

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Developers\Application\Service\Factory\ImportServiceFactory;

foreach(['craft.core', 'craft.develop', 'iblock'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = Application::getInstance()->getContext()->getRequest();
$error = null;
if($request->isPost())
{
	$adminSidePanelHelper->sendJsonErrorResponse(rand());
	try
	{
		$import = ImportServiceFactory::getService();
		$import->executeById(
			$request->getPost('developerId')
		);

		LocalRedirect(CRAFT_DEVELOP_ADMIN_URL_IMPORT);
	} catch(Exception $e)
	{
		$error = $e->getMessage();
	}
}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Импорт',
		"ICON"  => "iblock_section",
		"TITLE" => 'Импорт',
	],
];


$tabControl = new CAdminForm('craftDeveloperEditTabControl', $aTabs);
$tabControl->BeginEpilogContent();
$tabControl->EndEpilogContent();
$tabControl->Begin();
if($error)
{
	CAdminMessage::ShowOldStyleError($error);
}
$tabControl->BeginNextFormTab();


$tabControl->AddDropDownField(
	'developerId',
	'Застройщик',
	true,
	(function() {
		$result = [null => 'Выберите застройщика'];

		foreach(DeveloperTable::getList()->fetchCollection() as $developer)
		{
			$result[$developer->getId()] = $developer->getName();
		}

		return $result;
	})()
);


$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_IMPORT . "?lang=" . LANG,
]);

$tabControl->Show();


echo
BeginNote(),
	'Время: ' . date("d.m.Y H:i"),
'</a>',
EndNote();


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_popup_admin.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin_js.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");