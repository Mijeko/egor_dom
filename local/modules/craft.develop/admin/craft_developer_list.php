<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Застройщики");

use Craft\Core\Helper\AdminPanel\Element\ContextMenu\GreenButton;
use Craft\Core\Helper\AdminPanel\Element\ListHeader;
use Craft\Core\Helper\AdminPanel\ListManager;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;


ListManager::instance()
	->driver(DeveloperTable::class)
	->modules('craft.develop')
	->contextButtons([
		GreenButton::build('Добавить застройщика', CRAFT_DEVELOP_ADMIN_URL_EDIT_DEVELOPERS . "?lang=" . LANG, 'Создать'),
	])
	->headers([
		ListHeader::build(DeveloperTable::F_ID, 'ID', true),
		ListHeader::build(DeveloperTable::F_CITY_ID, 'Город', true),
		ListHeader::build(DeveloperTable::F_NAME, 'Название', true),
		ListHeader::build(DeveloperTable::F_ACTIVE, 'Активность', true),
		ListHeader::build(DeveloperTable::F_SORT, 'Сортировка', true),
	])
	->show();
?>
