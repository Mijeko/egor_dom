<?php

use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;

class craft_modal extends CModule
{
	const MODULE_ID = 'craft.modal';
	const DIR_MODULE = 'local';

	var $MODULE_ID = "craft.modal";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME = '[craft] Модальные окна';
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
		if(!$DB->TableExists('craft_modal'))
		{
			$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/local/modules/' . $this->MODULE_ID . '/install/db/create.sql');
		}

	}

	function UnInstallDB($arParams = [])
	{
		global $DB, $APPLICATION;
		$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/" . self::DIR_MODULE . "/modules/" . $this->MODULE_ID . "/install/db/delete.sql");
	}

	function InstallEvents()
	{

	}

	function UnInstallEvents()
	{
	}

	function InstallFiles()
	{
//		CopyDirFiles(
//			$_SERVER['DOCUMENT_ROOT'] . '/' . self::DIR_MODULE . '/modules/' . self::MODULE_ID . '/install/admin',
//			$_SERVER['DOCUMENT_ROOT'] . "/bitrix/admin"
//		);

		CopyDirFiles(
			$_SERVER['DOCUMENT_ROOT'] . '/' . self::DIR_MODULE . '/modules/' . self::MODULE_ID . '/install/components',
			$_SERVER['DOCUMENT_ROOT'] . "/" . self::DIR_MODULE . "/components",
			true,
			true,
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
		$this->InstallDB();
		$this->InstallEvents();
		$this->InstallFiles();

		RegisterModule($this->MODULE_ID);
	}

	function DoUninstall()
	{
		$this->UnInstallDB();
		$this->UnInstallEvents();
		$this->UnInstallFiles();

		UnRegisterModule($this->MODULE_ID);
	}
}
