<?php

//define('NEED_AUTH', true);
use Craft\DDD\City\Infrastructure\Factory\CurrentCityFactory;

if(\Bitrix\Main\Loader::includeModule('craft.core'))
{
	require_once __DIR__ . '/defines.php';
}

if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php"))
{
	include_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php";
}

if(file_exists(__DIR__ . '/vendor/autoload.php'))
{
	include_once __DIR__ . '/vendor/autoload.php';
} else if(file_exists($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/Psr4AutoloaderClass.php'))
{
	include_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/Psr4AutoloaderClass.php';
	$loader = new Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\", $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib');
	$loader->register();
}

foreach([
			'craft.form',
			'craft.modal',
		] as $module)
{
	\Bitrix\Main\Loader::includeModule($module);
}

require_once __DIR__ . '/dev_functions.php';
if(file_exists(__DIR__ . '/../js/config.php'))
{
	require_once __DIR__ . '/../js/config.php';
}

$city = CurrentCityFactory::getService();
$city->current();

if(file_exists(__DIR__ . '/events.php'))
{
	require_once __DIR__ . '/events.php';
}

