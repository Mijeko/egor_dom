<?php

use Craft\Inertia\Ssr\BundleDetector;

$modulePath = $_SERVER["DOCUMENT_ROOT"] . '/local/modules/craft.inertia';
$loaderPath = $modulePath . '/Psr4AutoloaderClass.php';

if(file_exists(__DIR__ . '/vendor/autoload.php'))
{
	include_once __DIR__ . '/vendor/autoload.php';
} else if(file_exists($loaderPath))
{
	include_once $loaderPath;

	$loader = new \Craft\Core\Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\Inertia\\", $modulePath . '/lib');
	$loader->register();
}

require_once __DIR__ . '/helpers.php';

$factory = \inertia();
$factory->version($factory->getVersionFromManifest());
$factory->setBundlePath((new BundleDetector())->detect());
$config = $factory->getConfig()->mergeWith(__DIR__ . '/configs/inertia.php');
if(file_exists($userConfigFile = $factory->getLocalRoot() . '/php_interface/inertia.config.php')) {
    $config->mergeWith($userConfigFile);
}
