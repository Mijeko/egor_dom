<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
/**
 * @global CMain $APPLICATION
 */

global $APPLICATION, $USER;


$APPLICATION->IncludeComponent(
	'craft:stream',
	'.default',
	[
		'USER_ID' => $USER->GetID(),
	],
	false,
	['HIDE_ICONS' => 'Y']
);
