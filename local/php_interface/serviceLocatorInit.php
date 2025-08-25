<?php

use Bitrix\Main\DI\ServiceLocator;
use Craft\DDD\Referal\Infrastructure\Events\AuthorizeListener;
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


dispatcher()->addListener('onAuthorize', [
	new AuthorizeListener,
	'handle',
]);