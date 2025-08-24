<?php

namespace Craft\DDD\User\Infrastructure\Events;

use Bitrix\Main\Diag\Debug;
use Symfony\Contracts\EventDispatcher\Event;

class AuthorizeListener
{
	public function handle(AuthorizeEvent $event): void
	{
	}
}