<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php

/**
 * @global CMain $APPLICATION
 */

if(empty($arResult))
{
	return;
}

$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'ProfileAsideMenu',
		'PROPS'  => [
			'items' => array_map(function($item) {
				return [
					'icon'     => $item['PARAMS']['ICON'],
					'href'     => $item['LINK'],
					'title'    => $item['TEXT'],
					'selected' => $item['SELECTED'],
				];
			}, $arResult),
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>