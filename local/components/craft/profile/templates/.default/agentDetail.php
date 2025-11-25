<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

global $APPLICATION;

/**
 * @var array $arResult
 * @var array $arParams
 * @global CMain $APPLICATION
 */

$agentId = $arResult['VARIABLES']['AGENT_ID'];

$APPLICATION->IncludeComponent(
	'craft:agent.edit',
	'.default',
	[
		'ID' => $agentId,
	],
	false,
	['HIDE_ICONS' => 'Y']
);