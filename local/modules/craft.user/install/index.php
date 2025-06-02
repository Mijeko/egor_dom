<?php

class craft_user extends CModule
{
	const MODULE_ID = 'craft.user';
	const DIR_MODULE = 'local';

	var $MODULE_ID = "craft.user";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME = '[craft] Пользователи';
	var $MODULE_DESCRIPTION = 'Компоненты авторизации/регистрации/личного кабинета';
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
		if(!$DB->TableExists('craft_user'))
		{
			$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/local/modules/' . $this->MODULE_ID . '/install/db/install.sql');
		}

	}

	function UnInstallDB($arParams = [])
	{
		global $DB, $APPLICATION;
		$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/" . self::DIR_MODULE . "/modules/" . $this->MODULE_ID . "/install/db/uninstall.sql");
	}

	function InstallEvents()
	{

		if(!\Bitrix\Main\Loader::includeModule(self::MODULE_ID))
		{
			throw new Exception('Модуль ' . self::MODULE_ID . ' не подключен');
		}
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
		$this->InstallFiles();

		RegisterModule($this->MODULE_ID);

		$this->InstallEvents();
	}

	function DoUninstall()
	{
		$this->UnInstallDB();
		$this->UnInstallEvents();
		$this->UnInstallFiles();

		UnRegisterModule($this->MODULE_ID);
	}
}
