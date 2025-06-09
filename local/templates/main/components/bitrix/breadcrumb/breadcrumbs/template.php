<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

if(empty($arResult))
{
	return;
}

$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'Breadcrumbs',
		'PROPS'  => [
			'items' => array_map(function($item) {
				return [
					'disabled' => false,
					'title'    => $item['TITLE'],
					'href'     => $item['LINK'],
				];
			}, $arResult),
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
);
