<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

use Bitrix\Main\Loader;
use Craft\Core\Helper\AdminPanel\Element\Actions\DeleteAction;
use Craft\Core\Helper\AdminPanel\Element\Actions\EditAction;
use Craft\Core\Helper\AdminPanel\Element\ContextMenu\GreenButton;
use Craft\Core\Helper\AdminPanel\Element\Filter\FilterFieldInput;
use Craft\Core\Helper\AdminPanel\Element\ListHeader;
use Craft\Core\Helper\AdminPanel\FilterManager;
use Craft\Core\Helper\AdminPanel\ListManager;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;


Loader::includeModule('craft.develop');

global $APPLICATION;

$APPLICATION->SetTitle('Застройщики');

$manager = ListManager::instance(
	'craft.develop',
	DeveloperTable::getTableName()
)
	->driver(DeveloperTable::class)
	->contextButtons([
		GreenButton::build('Добавить застройщика', CRAFT_DEVELOP_ADMIN_URL_EDIT_DEVELOPERS . "?lang=" . LANG, 'Создать'),
	])
	->actions([
		function(CAdminList $lAdmin, int $elementId) {
			return EditAction::build($lAdmin->ActionRedirect(CRAFT_DEVELOP_ADMIN_URL_EDIT_DEVELOPERS . "?ID=" . $elementId));
		},
		function(CAdminList $lAdmin, int $elementId, string $elementName) {
			return DeleteAction::build("if(confirm('Точно удалить " . $elementName . "?')) " . $lAdmin->ActionDoGroup($elementId, "delete"));
		},
	])
	->filter(
		FilterManager::instance(DeveloperTable::getTableName())
			->fields([
				FilterFieldInput::build(DeveloperTable::F_ID, 'ID'),
				FilterFieldInput::build(DeveloperTable::F_NAME, 'Название'),
				FilterFieldInput::build(DeveloperTable::F_SORT, 'Сортировка'),
			])
	)
	->modifiers([
	])
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