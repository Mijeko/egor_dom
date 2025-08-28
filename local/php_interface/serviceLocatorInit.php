<?php

use Bitrix\Main\DI\ServiceLocator;
use Craft\DDD\Referal\Infrastructure\Listeners\AuthorizeListener;
use Craft\DDD\Referal\Infrastructure\Listeners\InviteStudentToStudentListener;
use Craft\DDD\User\Infrastructure\Events\AuthorizeEvent;
use Craft\DDD\User\Infrastructure\Events\InviteStudentToStudentEvent;
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


dispatcher()->addListener(AuthorizeEvent::EVENT_NAME, [
	new AuthorizeListener,
	'handle',
]);

dispatcher()->addListener(InviteStudentToStudentEvent::EVENT_NAME, [
	new InviteStudentToStudentListener(),
	'handle',
]);