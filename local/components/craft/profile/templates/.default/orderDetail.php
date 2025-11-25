<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

global $APPLICATION;

/**
 * @var array $arResult
 * @var array $arParams
 * @global CMain $APPLICATION
 */

$orderId = $arResult['VARIABLES']['ORDER_ID'];

$APPLICATION->IncludeComponent(
	'craft:claim.detail',
	'.default',
	[
		'ID' => $orderId,
	],
	false,
	['HIDE_ICONS' => 'Y']
);