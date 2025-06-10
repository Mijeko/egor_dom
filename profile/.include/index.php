<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;


$APPLICATION->IncludeComponent(
	'craft:profile',
	'.default',
	[
		'SEF_FOLDER'        => '/profile/',
		'SEF_MODE'          => 'Y',
		'SEF_URL_TEMPLATES' => [
			''         => 'main',
			'orders'   => 'orders/',
			'settings' => 'settings/',
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
