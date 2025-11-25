<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

global $APPLICATION;

/**
 * @var array $arResult
 * @var array $arParams
 * @global CMain $APPLICATION
 */

$studentId = $arResult['VARIABLES']['STUDENT_ID'];

$APPLICATION->IncludeComponent(
	'craft:student.detail',
	'.default',
	[
		'ID' => $studentId,
	],
	false,
	['HIDE_ICONS' => 'Y']
);