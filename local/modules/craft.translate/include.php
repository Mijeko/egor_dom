<?php
$modulePath = $_SERVER["DOCUMENT_ROOT"] . '/local/modules/craft.translate';
$loaderPath = $modulePath . '/Psr4AutoloaderClass.php';

if(file_exists($loaderPath))
{
	include_once $loaderPath;

	$loader = new \Craft\Translate\Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\Translate\\", $modulePath . '/lib/Craft');
	$loader->register();

	exit();
}

define('CRAFT_TRANSLATE_ADMIN_URL_LIST_DICTIONARY', '/bitrix/admin/craft_translate_manage.php');
define('CRAFT_TRANSLATE_ADMIN_URL_EDIT_DICTIONARY', '/bitrix/admin/craft_translate_manage.php');