<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @global CMain $APPLICATION
 */


$APPLICATION->IncludeComponent(
	'craft:auth',
	'.default',
	[],
	false,
	['HIDE_ICONS' => 'Y']
)
?>
