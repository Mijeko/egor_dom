<?php

$modulePath = $_SERVER["DOCUMENT_ROOT"] . '/local/modules/craft.form';
$loaderPath = $modulePath . '/Psr4AutoloaderClass.php';

if(file_exists($loaderPath))
{
	include_once $loaderPath;

	$loader = new \Craft\Form\Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\Websocket\\", $modulePath . '/lib');
	$loader->register();
}


$jsConfigPath = __DIR__ . '/js/config.php';
if(file_exists($jsConfigPath))
{
	include_once $jsConfigPath;
}

if(!\Bitrix\Main\Loader::includeModule("craft.core"))
{
	return;
}

define('CRAFT_WEBSOCKET_ADMIN_URL_MANAGER', '');