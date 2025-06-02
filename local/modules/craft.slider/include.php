<?php

$modulePath = $_SERVER["DOCUMENT_ROOT"] . '/local/modules/craft.slider';
$loaderPath = $modulePath . '/Psr4AutoloaderClass.php';

if(file_exists($loaderPath))
{
	include_once $loaderPath;

	$loader = new \Craft\Slider\Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\Slider\\", $modulePath . '/lib');
	$loader->register();
}


$jsConfigPath = __DIR__ . '/js/config.php';
if(file_exists($jsConfigPath))
{
	include_once $jsConfigPath;
}