<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$APPLICATION->IncludeComponent(
	'craft:claims',
	'.default',
	[
		'USER_ID' => \Craft\Model\CraftUser::load()->getId(),
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
