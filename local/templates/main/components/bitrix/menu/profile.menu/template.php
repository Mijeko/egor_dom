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
			'user'  => [
				'avatar' => \Craft\Model\CraftUser::load()->getAvatarPath(),
				'email'  => \Craft\Model\CraftUser::load()->getEmail(),
				'name'   => \Craft\Model\CraftUser::load()->getFullName(),
			],
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