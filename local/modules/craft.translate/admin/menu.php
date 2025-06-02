<?php

if(!\Bitrix\Main\Loader::includeModule('craft.translate'))
{
	return;
}

$aMenu = [
	"parent_menu" => "global_menu_content",
	"section"     => "craft.translate",
	"sort"        => 1000,
	"url"         => CRAFT_TRANSLATE_ADMIN_URL_LIST_DICTIONARY . "?lang=" . LANG,
	"text"        => '[craft] Перевод текста',
	"title"       => 'Перевод текста',
	"icon"        => "iblock_menu_icon_settings",
	"page_icon"   => "iblock_menu_icon_settings",
	"items_id"    => "menu_craft_area",
	"items"       => [
	],

];

return (!empty($aMenu) ? $aMenu : false);