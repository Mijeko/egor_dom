<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"profile.menu",
	[
		"COMPONENT_TEMPLATE"    => "profile.menu",
		"ROOT_MENU_TYPE"        => "profile_aside",
		"MENU_CACHE_TYPE"       => "N",
		"MENU_CACHE_TIME"       => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS"   => [
		],
		"MAX_LEVEL"             => "1",
		"CHILD_MENU_TYPE"       => "",
		"USE_EXT"               => "N",
		"DELAY"                 => "N",
		"ALLOW_MULTI_SELECT"    => "N",
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
