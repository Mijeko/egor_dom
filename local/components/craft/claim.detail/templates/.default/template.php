<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use Craft\DDD\Claims\Present\Dto\ClaimDto;

/**
 * @var array $arResult
 * @var array $arParams
 * @var \Craft\DDD\Claims\Domain\Entity\ClaimEntity $claim
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
			'claim' => ClaimDto::fromEntity($claim),
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
)
?>
