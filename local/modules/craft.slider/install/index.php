<?php

class craft_slider extends CModule
{
	const MODULE_ID = 'craft.slider';
	const DIR_MODULE = 'local';

	var $MODULE_ID = "craft.slider";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME = '[craft] Адаптивный слайдер';
	var $MODULE_DESCRIPTION = 'Слайдер с использованием swiper.js и возможностью указать точки адаптива для конкретной картинки';
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
			\Craft\Slider\IBlockProperties\SliderProperty::class,
			"getTypeDescription",
			10
		);
	}

	function UnInstallEvents()
	{
		$eventManager = \Bitrix\Main\EventManager::getInstance();

		$eventManager->unRegisterEventHandler(
			"iblock",
			"OnIBlockPropertyBuildList",
			$this->MODULE_ID,
			\Craft\Slider\IBlockProperties\SliderProperty::class,
			"GetUserTypeDescription"
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

		RegisterModule("craft.slider");
	}

	function DoUninstall()
	{
		$this->UnInstallDB();
		$this->UnInstallEvents();
		$this->UnInstallFiles();

		UnRegisterModule("craft.slider");
	}
}
