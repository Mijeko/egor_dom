<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @global CMain $APPLICATION
 */
$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'Auth',
	],
	false,
	['HIDE_ICONS' => 'Y']
)
?>
