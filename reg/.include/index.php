<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

global $APPLICATION, $USER;

if($USER->IsAuthorized())
{
	LocalRedirect("/");
}

$APPLICATION->IncludeComponent(
	'craft:register',
	'vue',
	[],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
