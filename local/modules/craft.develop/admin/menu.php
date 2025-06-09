<?php

if(!\Bitrix\Main\Loader::includeModule('craft.develop'))
{
	return;
}

$aMenu = [
	"parent_menu" => "global_menu_content",
	"section"     => "craft.develop",
	"sort"        => 1000,
	"url"         => CRAFT_DEVELOP_ADMIN_URL_LIST_DEVELOPERS . "?lang=" . LANG,
	"text"        => '[craft] Застройщики',
	"title"       => 'Застройщики',
	"icon"        => "iblock_menu_icon_settings",
	"page_icon"   => "iblock_menu_icon_settings",
	"items_id"    => "menu_craft_develop",
	"items"       => [
	],

];

return (!empty($aMenu) ? $aMenu : false);