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
			''               => 'main',
			'stream'         => 'stream/',
			'settings'       => 'settings/',
			'education'      => 'education/',
			'orders'         => 'orders/',
			'orderAccept'    => 'order/accept/#ORDER_ID#/',
			'managerListAll' => 'managers/',
			'agentListAll'   => 'agents/',
			'studentListAll' => 'students/',
			'orderDetail'    => 'orders/#ORDER_ID#/',
			'managerDetail'  => 'managers/#MANAGER_ID#/',
			'agentDetail'    => 'agents/#AGENT_ID#/',
			'studentDetail'  => 'students/#STUDENT_ID#/',
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>
