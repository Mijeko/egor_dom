<?php

if(!\Bitrix\Main\Loader::includeModule('craft.websocket'))
{
	return;
}

$aMenu = [
	"parent_menu" => "global_menu_services",
	"section"     => "craft.websocket",
	"sort"        => 1000,
	"url"         => CRAFT_WEBSOCKET_ADMIN_URL_MANAGER . "?lang=" . LANG,
	"text"        => '[craft] Вебсокеты',
	"title"       => 'Вебсокеты',
	"icon"        => "iblock_menu_icon_settings",
	"page_icon"   => "iblock_menu_icon_settings",
	"items_id"    => "menu_craft_websocket",

];

return (!empty($aMenu) ? $aMenu : false);