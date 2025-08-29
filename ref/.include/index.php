<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Craft\DDD\Referal\Application\Factory\MarkGuestUseCaseFactory;

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;


$request = Application::getInstance()->getContext()->getRequest();
$refCode = $request->get('JOIN_REF_CODE') ?? '';

try
{
	$service = MarkGuestUseCaseFactory::getUseCase();
	$service->execute($refCode);
} catch(\Exception $e)
{
}

$APPLICATION->IncludeComponent(
	'craft:referral.join',
	'.default',
	[
		'CODE' => $refCode,
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>