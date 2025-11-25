<?php use Craft\Model\CraftUser;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
/**
 * @global CMain $APPLICATION
 */

$APPLICATION->IncludeComponent(
	'craft:claim.list',
	'.default',
	[
		'USER_ID' => CraftUser::load()?->getId(),
	],
	false,
	['HIDE_ICONS' => 'Y']
);