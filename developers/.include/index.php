<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$APPLICATION->IncludeComponent(
	'craft:developers',
	'.default',
	[
		#'IBLOCK_ID' => BUILD_DEVELOPERS_IBLOCK_ID,
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
