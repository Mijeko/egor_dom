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
	"text"        => '[craft] Застройщики',
	"title"       => 'Застройщики',
	"icon"        => "iblock_menu_icon_settings",
	"page_icon"   => "iblock_menu_icon_settings",
	"items_id"    => "menu_craft_develop",
	"items"       => [
//		[
//			"text"     => GetMessage("FORUM_LIST"),
//			"url"      => "/bitrix/admin/forum_admin.php?lang=" . LANG,
//			"more_url" => ["/bitrix/admin/forum_edit.php"],
//			"title"    => GetMessage("FORUM_CONTROL_ALT"),
//		],
	],

];

return (!empty($aMenu) ? $aMenu : false);