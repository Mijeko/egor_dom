<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 * @var array $arResult
 *
 * @var \Craft\Dto\ProfileEditUserDataDto $userData
 */

$userData = $arResult['USER_DATA'];

inertia('profile/settings', [
	'userData' => $userData,
]);