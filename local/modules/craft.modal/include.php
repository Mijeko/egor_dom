<?php
$modulePath = $_SERVER["DOCUMENT_ROOT"] . '/local/modules/craft.modal';
$loaderPath = $modulePath . '/Psr4AutoloaderClass.php';

if(file_exists($loaderPath))
{
	include_once $loaderPath;

	$loader = new \Craft\Modal\Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\Modal\\", $modulePath . '/lib');
	$loader->register();
}


$jsConfigPath = __DIR__ . '/js/config.php';
if(file_exists($jsConfigPath))
{
	include_once $jsConfigPath;
}

CJSCore::Init([
	'craft.modal.core',
]);

\Bitrix\Main\Loader::includeModule('craft.core');
