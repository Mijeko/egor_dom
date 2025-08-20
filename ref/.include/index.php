<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$APPLICATION->IncludeComponent(
	'craft:referral.join',
	'.default',
	[
		'CODE' => uniqid(),
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>