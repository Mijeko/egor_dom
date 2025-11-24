<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

if(empty($_REQUEST['ELEMENT_ID']))
{
	LocalRedirect('/objects/');
}


$APPLICATION->IncludeComponent(
	'craft:page.object.detail',
	'.default',
	[
		'ELEMENT_ID' => $_REQUEST['ELEMENT_ID'],
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
