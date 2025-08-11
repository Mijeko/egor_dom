<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use Craft\DDD\Claims\Present\Dto\ClaimDetailDto;

/**
 * @var array $arResult
 * @var array $arParams
 * @var ClaimDetailDto $claim
 * @global CMain $APPLICATION
 */

$claim = $arResult['CLAIM'];
?>

<?php
$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'ClaimDetail',
		'PROPS'  => [
			'claim' => $claim->claim,
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
)
?>
