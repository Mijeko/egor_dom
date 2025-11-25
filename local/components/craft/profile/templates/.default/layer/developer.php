<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;
?>

<h1><?php $APPLICATION->ShowTitle(); ?></h1>

<?php
$APPLICATION->IncludeComponent(
	'craft:developer.update',
	'.default',
	[],
	false,
	['HIDE_ICONS' => 'Y']
);
?>