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

	$loader = new \Craft\Inertia\Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\Inertia\\", $modulePath . '/lib');
	$loader->register();
}

require_once __DIR__ . '/helpers.php';

$factory = inertia();

$config = $factory->getConfig()->mergeWith(__DIR__ . '/configs/inertia.php');


$configList = array_filter(
	[
		$factory->getLocalRoot() . '/php_interface/config/' . SITE_ID . '/inertia.config.php',
		$factory->getLocalRoot() . '/php_interface/config/inertia.config.php',
	],
	function(string $file) {
		return file_exists($file);
	});

$configPath = null;
if(count($configList) == 1)
{
	$configPath = array_shift($configList);
}

if($configPath)
{
	$config->mergeWith($configPath);
}

$factory->version($factory->getVersionFromManifest());
$factory->setBundlePath((new BundleDetector())->detect($config->get('build.dir')));


$vite = vite();
if($configPath)
{
	$viteConfig = $vite->getConfig();
	$viteConfig->mergeWith($configPath);
}
