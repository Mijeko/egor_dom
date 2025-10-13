<?php

namespace Craft\DDD\Notify\Infrastructure\Listeners;

use Craft\DDD\Claims\Infrastructure\Events\ClaimCreateEvent;
use Craft\DDD\Notify\Application\Factory\ManagerNotificatorServiceFactory;

class ClaimCreateListener
{
	public function handle(ClaimCreateEvent $event): void
	{
		$managerNotificatorService = ManagerNotificatorServiceFactory::getService();
		$managerNotificatorService->aboutNewClaim($event->getClaim());
	}
}