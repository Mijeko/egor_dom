<?php

namespace Craft\DDD\Notify\Application\Listeners;

use Craft\DDD\Claims\Infrastructure\Events\ClaimAcceptManagerEvent;
use Craft\DDD\Notify\Application\Factory\ClaimAcceptManagerUseCaseFactory;

class ClaimAcceptManagerListener
{
	public function handle(ClaimAcceptManagerEvent $event): void
	{
		$service = ClaimAcceptManagerUseCaseFactory::getUseCase();
		$service->handle($event->getClaim());
	}
}