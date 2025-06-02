<?php

if(!\Bitrix\Main\Loader::includeModule('craft.user'))
{
	return;
}

$aMenu = [
	"parent_menu" => "global_menu_content",
	"section"     => "craft.area",
	"sort"        => 1000,
	"url"         => CRAFT_USER_ADMIN_URL_LIST_AREA,
	"text"        => '[craft] Пользователи',
	"title"       => 'Редактируемые блоки',
	"icon"        => "iblock_menu_icon_settings",
	"page_icon"   => "iblock_menu_icon_settings",
	"items_id"    => "menu_craft_area",
	"items"       => [
	],

];

return (!empty($aMenu) ? $aMenu : false);