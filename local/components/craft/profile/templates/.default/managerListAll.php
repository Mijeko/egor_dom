<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle('Список менеджеров');

$APPLICATION->IncludeComponent(
	'craft:manager.list',
	'listAll',
	[],
	false,
	['HIDE_ICONS' => 'Y']
);