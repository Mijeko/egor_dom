<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;


$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$APPLICATION->IncludeComponent(
	'craft:referral.join',
	'.default',
	[
		'CODE' => $request->get('JOIN_REF_CODE') ?? '',
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>