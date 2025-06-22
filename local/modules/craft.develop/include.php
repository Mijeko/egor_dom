<?php

$modulePath = $_SERVER["DOCUMENT_ROOT"] . '/local/modules/craft.form';
$loaderPath = $modulePath . '/Psr4AutoloaderClass.php';

if(file_exists($loaderPath))
{
	include_once $loaderPath;

	$loader = new \Craft\Form\Psr4AutoloaderClass();
	$loader->addNamespace("Craft\\Develop\\", $modulePath . '/lib');
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


define('CRAFT_DEVELOP_ADMIN_URL_LIST_DEVELOPERS', '/bitrix/admin/craft_developer_list.php');
define('CRAFT_DEVELOP_ADMIN_URL_LIST_OBJECTS', '/bitrix/admin/craft_developer_object_list.php');
define('CRAFT_DEVELOP_ADMIN_URL_LIST_APARTMENTS', '/bitrix/admin/craft_developer_apartments_list.php');

define('CRAFT_DEVELOP_ADMIN_URL_EDIT_DEVELOPERS', '/bitrix/admin/craft_developer_edit.php');
define('CRAFT_DEVELOP_ADMIN_URL_EDIT_OBJECTS', '/bitrix/admin/craft_developer_object_edit.php');
define('CRAFT_DEVELOP_ADMIN_URL_EDIT_APARTMENTS', '/bitrix/admin/craft_developer_apartments_edit.php');