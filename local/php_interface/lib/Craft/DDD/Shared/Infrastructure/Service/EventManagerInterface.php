<?php

namespace Craft\DDD\Shared\Infrastructure\Service;

use Symfony\Contracts\EventDispatcher\Event;

class EventManagerInterface
{

	public static ?EventManagerInterface $instance = null;

	public static function getInstance(): EventManagerInterface
	{
		if(self::$instance === null)
		{
			self::$instance = new EventManagerInterface();
		}

		return self::$instance;
	}

	public function dispatch(Event $event, string $eventName = null): void
	{
		dispatcher()->dispatch($event, $eventName);
	}
}