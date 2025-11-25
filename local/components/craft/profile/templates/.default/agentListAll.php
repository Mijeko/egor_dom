<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle('Список агентов');

$APPLICATION->IncludeComponent(
	'craft:agent.list',
	'listAll',
	[],
	false,
	['HIDE_ICONS' => 'Y']
);