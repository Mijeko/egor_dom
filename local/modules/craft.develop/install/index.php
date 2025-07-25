<?php


class craft_develop extends CModule
{
	const MODULE_ID = 'craft.develop';
	const DIR_MODULE = 'local';

	var $MODULE_ID = "craft.develop";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME = '[craft] Модуль управления сайтом';
	var $MODULE_DESCRIPTION = '';
	var $MODULE_CSS;

	var $errors;

	function __construct()
	{
		$arModuleVersion = [];
		include(__DIR__ . '/version.php');
	}

	function InstallDB()
	{
		global $DB, $APPLICATION;
	}

	function UnInstallDB($arParams = [])
	{
		global $DB, $APPLICATION;
	}

	function InstallEvents()
	{

	}

	function UnInstallEvents()
	{

	}

	function InstallFiles()
	{
		CopyDirFiles(
			$_SERVER['DOCUMENT_ROOT'] . '/' . self::DIR_MODULE . '/modules/' . self::MODULE_ID . '/install/admin',
			$_SERVER['DOCUMENT_ROOT'] . "/bitrix/admin"
		);
	}

	function UnInstallFiles()
	{
		DeleteDirFiles(
			$_SERVER["DOCUMENT_ROOT"] . '/' . self::DIR_MODULE . '/modules/' . self::MODULE_ID . '/install/admin',
			$_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin"
		);
	}

	function DoInstall()
	{
		if(!\Bitrix\Main\Loader::includeModule('craft.core'))
		{
			throw new Exception('Модуль craft.core не установлен');
		}

		$this->InstallDB();
		$this->InstallEvents();
		$this->InstallFiles();

		RegisterModule(self::MODULE_ID);
	}

	function DoUninstall()
	{
		$this->UnInstallDB();
		$this->UnInstallEvents();
		$this->UnInstallFiles();

		UnRegisterModule(self::MODULE_ID);
	}
}
