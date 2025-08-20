<?php


use Bitrix\Main\DI\ServiceLocator;
use Craft\DDD\Claims\Infrastructure\Listeners\ClaimFinishListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

//\Bitrix\Main\DI\ServiceLocator::getInstance()->addInstanceLazy(
//	'',
//	'',
//);


ServiceLocator::getInstance()->addInstance(
	EventDispatcher::class,
	new EventDispatcher(),
);

if(!function_exists('dispatcher'))
{
	function dispatcher(): EventDispatcher
	{
		return ServiceLocator::getInstance()->get(EventDispatcher::class);
	}
}


dispatcher();

dispatcher()->addListener(ClaimFinishListener::class, [
	ClaimFinishListener::class,
	'onClaimFinish',
]);