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

inertia('profile/order/detail', [
	'claim' => $claim
]);