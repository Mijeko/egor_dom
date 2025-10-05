<?php

class craft_inertia extends CModule
{
	const MODULE_ID = 'craft.inertia';
	const DIR_MODULE = 'local';

	var $MODULE_ID = "craft.inertia";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME = '[craft] Inertia';
	var $MODULE_DESCRIPTION = 'Инструменты разработки';
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
			$_SERVER['DOCUMENT_ROOT'] . '/' . self::DIR_MODULE . '/modules/' . self::MODULE_ID . '/install/components',
			$_SERVER['DOCUMENT_ROOT'] . "/" . self::DIR_MODULE . "/components",
			true,
			true,
		);
	}

	function UnInstallFiles()
	{
	}

	function DoInstall()
	{
		$this->InstallEvents();
		RegisterModule(self::MODULE_ID);

		$this->InstallFiles();
	}

	function DoUninstall()
	{
		$this->UnInstallEvents();
		UnRegisterModule(self::MODULE_ID);
	}
}