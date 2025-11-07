<?php

if(!\Bitrix\Main\Loader::includeModule('craft.develop'))
{
	return;
}

//global_menu_content - раздел "Контент"
//global_menu_marketing - раздел "Маркетинг"
//global_menu_store - раздел "Магазин"
//global_menu_services - раздел "Сервисы"
//global_menu_statistics - раздел "Аналитика"
//global_menu_marketplace - раздел "Marketplace"
//global_menu_settings - раздел "Настройки"

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
			"text"  => "Заявки",
			"url"   => CRAFT_DEVELOP_ADMIN_URL_LIST_CLAIMS . "?lang=" . LANG,
			"title" => "Заявки",
		],
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
		[
			"text"  => "Объекты продажи",
			"url"   => CRAFT_DEVELOP_ADMIN_URL_LIST_APARTMENTS . "?lang=" . LANG,
			"title" => "Объекты продажи",
		],
		[
			"text"  => "Города",
			"url"   => CRAFT_DEVELOP_ADMIN_URL_LIST_CITY . "?lang=" . LANG,
			"title" => "Города",
		],
		[
			'text'  => 'Персонал',
			'url'   => '',
			'title' => 'Персонал',
			'items' => [
				[
					"text"  => "Риэлторы",
					"url"   => CRAFT_DEVELOP_ADMIN_URL_LIST_REALTOR . "?lang=" . LANG,
					"title" => "Риэлторы",
				],
				[
					"text"  => "Ученики",
					"url"   => CRAFT_DEVELOP_ADMIN_URL_LIST_STUDENT . "?lang=" . LANG,
					"title" => "Ученики",
				],
				[
					"text"  => "Менеджеры",
					"url"   => CRAFT_DEVELOP_ADMIN_URL_LIST_MANAGER . "?lang=" . LANG,
					"title" => "Менеджеры",
				],
			],
		],
		[
			"text"  => "Импорт",
			"url"   => CRAFT_DEVELOP_ADMIN_URL_IMPORT . "?lang=" . LANG,
			"title" => "Импорт",
		],
	],

];

return (!empty($aMenu) ? $aMenu : false);