<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Craft\DDD\Referal\Application\Factory\ReferralInformationServiceFactory;
use Craft\DDD\UserBehavior\Application\Factory\ObtainViewedInformationUseCaseFactory;

/**
 * @global CUser $USER
 */

global $USER;

$ser = ReferralInformationServiceFactory::getService();
$uc = ObtainViewedInformationUseCaseFactory::getUseCase();

inertia('profile/home', [
	'referralInfo' => $ser->obtainInformationByUserId($USER->GetID()),
	'viewedInfo'   => $uc->execute($USER->GetID()),
]);
