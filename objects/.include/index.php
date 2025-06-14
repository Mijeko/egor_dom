<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$APPLICATION->IncludeComponent(
	'craft:objects',
	'.default',
	[
		'IBLOCK_ID' => BUILD_OBJECT_IBLOCK_ID,
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
