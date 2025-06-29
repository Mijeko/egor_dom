<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Импорт");

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

if($request->isPost())
{

	$link = $request->getPost('sourceLink');

	$content = null;
	$cache = \Bitrix\Main\Data\Cache::createInstance(); // получаем экземпляр класса
	if($cache->initCache(7200, "cache_key"))
	{
		$vars = $cache->getVars();
		$content = $vars['xmlData'];
	} elseif($cache->startDataCache())
	{
		$content = file_get_contents($link);
		$cache->endDataCache(["xmlData" => $content]);
	}

	if(!$content)
	{
		LocalRedirect(CRAFT_DEVELOP_ADMIN_URL_IMPORT);
	}

	try
	{
		$import = \Craft\DDD\Developers\Infrastructure\Service\Factory\ImportServiceFactory::getService();
		$import->execute(
			$request->getPost('developerId'),
			$content
		);
	} catch(Exception $e)
	{
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
$tabControl->AddEditField(
	'sourceLink',
	'Ссылка на источник',
	true
);


$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_IMPORT . "?lang=" . LANG,
]);

$tabControl->Show();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");