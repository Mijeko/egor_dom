<?php

use Bitrix\Main\DI\ServiceLocator;
use Craft\DDD\Claims\Infrastructure\Listeners\ClaimFinishListener;
use Craft\DDD\User\Infrastructure\Events\AgentRegisterListener;
use Craft\DDD\User\Infrastructure\Events\AuthorizeListener;
use Symfony\Component\EventDispatcher\EventDispatcher;


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


//dispatcher()->addListener('onRegisterAgent', [
//	AgentRegisterListener::class,
//	'handle',
//]);

dispatcher()->addListener('onAuthorize', [
	new AuthorizeListener,
	'handle',
]);

//dispatcher()->addListener(ClaimFinishListener::class, [
//	ClaimFinishListener::class,
//	'handle',
//]);