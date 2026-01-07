<?php

use Bitrix\Main\DI\ServiceLocator;
use Craft\DDD\Claims\Infrastructure\Events\ClaimAcceptManagerEvent;
use Craft\DDD\Claims\Infrastructure\Events\ClaimCreateEvent;
use Craft\DDD\Notify\Infrastructure\Listeners\ClaimAcceptManagerListener;
use Craft\DDD\Notify\Infrastructure\Listeners\ClaimCreateListener;
use Craft\DDD\Referal\Infrastructure\Listeners\AuthorizeListener;
use Craft\DDD\Referal\Infrastructure\Listeners\InviteStudentToStudentListener;
use Craft\DDD\Referal\Infrastructure\Listeners\RegisterListener;
use Craft\DDD\User\Application\Event\UserRegisterEvent;
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

dispatcher()->addListener(ClaimAcceptManagerEvent::EVENT_NAME, [
	new ClaimAcceptManagerListener(),
	'handle',
]);

dispatcher()->addListener(ClaimCreateEvent::EVENT_NAME, [
	new ClaimCreateListener(),
	'handle',
]);

dispatcher()->addListener(UserRegisterEvent::EVENT_NAME, [
	new RegisterListener(),
	'handle',
]);