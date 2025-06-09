<?php

if(!\Bitrix\Main\Loader::includeModule('craft.develop'))
{
	return;
}

$aMenu = [
	"parent_menu" => "global_menu_services",
	"section"     => "craft.develop",
	"sort"        => 1000,
	"url"         => CRAFT_DEVELOP_ADMIN_URL_LIST_DEVELOPERS . "?lang=" . LANG,
	"text"        => '[craft] АБН',
	"title"       => 'АБН',
	"icon"        => "iblock_menu_icon_settings",
	"page_icon"   => "iblock_menu_icon_settings",
	"items_id"    => "menu_craft_develop",
	"items"       => [
		[
			"text"  => "Застройщики",
			"url"   => CRAFT_DEVELOP_ADMIN_URL_LIST_DEVELOPERS . "?lang=" . LANG,
			"title" => "Застройщики",
		],
		[
			"text"  => "Объекты",
			"url"   => CRAFT_DEVELOP_ADMIN_URL_LIST_OBJECTS . "?lang=" . LANG,
			"title" => "Объекты",
		],
	],

];

return (!empty($aMenu) ? $aMenu : false);