<?php

use Craft\Form\Admin\Property\FormFieldProperty;

class craft_form extends CModule
{
	const MODULE_ID = 'craft.form';
	const DIR_MODULE = 'local';

	var $MODULE_ID = "craft.form";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME = '[craft] Комплексные формы';
	var $MODULE_DESCRIPTION = 'Captcha, отправка E-mail, валидации, шаблоны';
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
		$eventManager = \Bitrix\Main\EventManager::getInstance();
		$eventManager->registerEventHandlerCompatible(
			'iblock',
			"OnIBlockPropertyBuildList",
			$this->MODULE_ID,
			FormFieldProperty::class,
			"getTypeDescription",
			10
		);

		$eventManager->registerEventHandlerCompatible(
			'craft.user',
			'OnModuleUnInstall',
			$this->MODULE_ID,
			'',
			'craftFormUnInstallEvent',
		);
	}

	function UnInstallEvents()
	{
		$eventManager = \Bitrix\Main\EventManager::getInstance();
		$eventManager->unRegisterEventHandler(
			'iblock',
			"OnIBlockPropertyBuildList",
			$this->MODULE_ID,
			FormFieldProperty::class,
			"getTypeDescription",
			10
		);
		$eventManager->unRegisterEventHandler(
			'craft.user',
			'OnModuleUnInstall',
			$this->MODULE_ID,
			'',
			'craftFormInstallEvent',
		);
	}

	function InstallFiles()
	{
		CopyDirFiles(
			$_SERVER["DOCUMENT_ROOT"] . "/" . self::DIR_MODULE . "/modules/" . $this->MODULE_ID . "/install/components",
			$_SERVER["DOCUMENT_ROOT"] . "/" . self::DIR_MODULE . "/components",
			true,
			true
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
