<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
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
 * @var CraftStreamComponent $component
 */
?>


<?php

$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'profile/Stream',
		'PROPS'  => [
			'chats' => $arResult['CHATS'],
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
)

?>