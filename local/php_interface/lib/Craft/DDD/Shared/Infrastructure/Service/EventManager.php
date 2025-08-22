<?php

namespace Craft\DDD\Shared\Infrastructure\Service;

use Symfony\Contracts\EventDispatcher\Event;

class EventManager
{

	public static ?EventManager $instance = null;

	public static function getInstance(): EventManager
	{
		if(self::$instance === null)
		{
			self::$instance = new EventManager();
		}

		return self::$instance;
	}

	public function dispatch(Event $event): void
	{
		dispatcher()->dispatch($event);
	}
}