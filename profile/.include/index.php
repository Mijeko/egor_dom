<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

define('NEED_AUTH', true);

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
			''               => 'main',
			'settings'       => 'settings/',
			'education'      => 'education/',
			'orders'         => 'orders/',
			'managerListAll' => 'managers/',
			'orderDetail'    => 'orders/#ORDER_ID#/',
			'managerDetail'  => 'managers/#MANAGER_ID#/',
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
