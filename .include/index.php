<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$APPLICATION->IncludeComponent(
	'craft:object.list',
	'.default',
	[],
	false,
	['HIDE_ICONS' => 'Y']
);

?>
