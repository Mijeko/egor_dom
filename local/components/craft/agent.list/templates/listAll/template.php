<?php

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Craft\Dto\BxUserDto;
use Craft\Helper\TableHeaderHelper;
use Craft\Helper\TableSettingsHelper;


/**
 * @var string $componentPath
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CraftAgentListComponent $component
 */


$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'AgentList',
		'PROPS'  => [
			'tableParams' => TableSettingsHelper::settings()
				->records(array_map(function(BxUserDto $agent) {
					return [
						'id'   => $agent->id,
						'name' => $agent->name,
					];
				}, $arResult['AGENTS'] ?? []))
				->header([
					TableHeaderHelper::build('id', 'ID'),
					TableHeaderHelper::build('name', 'Название'),
				])
				->build(),
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>