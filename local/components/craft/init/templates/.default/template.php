<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @global CMain $APPLICATION
 * @var array $arResult
 */


$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'system/Init',
		'PROPS'  => [
			'user'            => $arResult['USER'],
			'apartmentFilter' => $arResult['APARTMENT_FILTER'],
		],
	],
	false,
	['HIDE_ICONS' => true]
);
?>


