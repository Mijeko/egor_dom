<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

global $APPLICATION;

/**
 * @var array $arResult
 * @var array $arParams
 * @global CMain $APPLICATION
 */

$managerId = $arResult['VARIABLES']['MANAGER_ID'];


$APPLICATION->IncludeComponent(
	'craft:manager.edit',
	'.default',
	[
		'ID' => $managerId,
	],
	false,
	['HIDE_ICONS' => 'Y']
);