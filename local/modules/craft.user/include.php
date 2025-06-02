<?php

$modulePath = $_SERVER["DOCUMENT_ROOT"] . '/local/modules/craft.user';
$loaderPath = $modulePath . '/Psr4AutoloaderClass.php';

if(file_exists($loaderPath))
{
	include_once $loaderPath;

	$loader = new \Craft\User\Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\User\\", $modulePath . '/lib');
	$loader->register();
}

\Bitrix\Main\Loader::includeModule("craft.core");

$jsConfigPath = __DIR__ . '/js/config.php';
if(file_exists($jsConfigPath))
{
	include_once $jsConfigPath;
}

define('CRAFT_USER_ADMIN_URL_LIST_AREA', 'craft_user_auth_settings.php');
define('JEDI_USER_ADMIN_URL_LIST_AREA', 'craft_user_auth_settings.php');