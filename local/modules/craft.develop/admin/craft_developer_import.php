<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Импорт");

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Developers\Infrastructure\Service\Factory\ImportServiceFactory;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = Application::getInstance()->getContext()->getRequest();

if($request->isPost())
{
	try
	{
		$import = ImportServiceFactory::getService();
		$import->execute(
			$request->getPost('developerId')
		);
	} catch(Exception $e)
	{
		\Bitrix\Main\Diag\Debug::dumpToFile($e->getMessage());
		LocalRedirect(CRAFT_DEVELOP_ADMIN_URL_IMPORT);
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
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");