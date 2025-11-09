<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

use Bitrix\Main\Loader;
use Craft\Core\Helper\AdminPanel\Element\ContextMenu\GreenButton;
use Craft\Core\Helper\AdminPanel\Element\Filter\FilterFieldInput;
use Craft\Core\Helper\AdminPanel\Element\ListHeader;
use Craft\Core\Helper\AdminPanel\FilterManager;
use Craft\Core\Helper\AdminPanel\ListManager;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;


Loader::includeModule('craft.develop');

global $APPLICATION;

$APPLICATION->SetTitle('Застройщики');

// здесь будет вся серверная обработка и подготовка данных
$sTableID = DeveloperTable::getTableName(); // ID таблицы
$oSort = new CAdminSorting($sTableID, "ID", "desc"); // объект сортировки
$lAdmin = new CAdminList($sTableID, $oSort); // основной объект списка


$manager = ListManager::instance(
	'craft.develop',
	$sTableID,
	$lAdmin
)
	->driver(DeveloperTable::class)
	->contextButtons([
		GreenButton::build('Добавить застройщика', CRAFT_DEVELOP_ADMIN_URL_EDIT_DEVELOPERS . "?lang=" . LANG, 'Создать'),
	])
	->filter(
		FilterManager::instance($sTableID)
			->fields([
				FilterFieldInput::build(DeveloperTable::F_ID, 'ID'),
				FilterFieldInput::build(DeveloperTable::F_NAME, 'Название'),
				FilterFieldInput::build(DeveloperTable::F_SORT, 'Сортировка'),
			])
	)
	->headers([
		ListHeader::build(DeveloperTable::F_ID, 'ID', true, 'id'),
		ListHeader::build(DeveloperTable::F_CITY_ID, 'Город', true),
		ListHeader::build(DeveloperTable::F_NAME, 'Название', true),
		ListHeader::build(DeveloperTable::F_ACTIVE, 'Активность', true),
		ListHeader::build(DeveloperTable::F_SORT, 'Сортировка', true),
	]);


$manager->build();


# второй общий пролог
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");


# здесь будет вывод страницы
$manager->show();

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");