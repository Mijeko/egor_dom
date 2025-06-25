<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 * @var array $arResult
 */

$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'BottomFloatMenu',
		'PROPS'  => [
			'menuItems' => array_map(function(array $item) {
				return new \Craft\Dto\FloatBottomMenuItemDto(
					$item['TEXT'],
					$item['LINK'],
					$item['PARAMS']['ICON'],
				);
			}, $arResult),
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
);

?>