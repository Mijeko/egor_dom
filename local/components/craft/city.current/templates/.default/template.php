<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 */
?>
<?php

$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'CurrentCity',
		'PROPS'  => [
			'currentCity' => $arResult['CURRENT'],
			'cityList'    => $arResult['CITY_LIST'],
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
);

?>
