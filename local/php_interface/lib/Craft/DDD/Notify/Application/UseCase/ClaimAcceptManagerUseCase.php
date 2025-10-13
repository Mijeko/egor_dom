<?php

namespace Craft\DDD\Notify\Application\UseCase;

use Craft\DDD\Notify\Application\Factory\ManagerNotificatorServiceFactory;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;

class ClaimAcceptManagerUseCase
{
	public function handle(ClaimEntity $claimEntity): void
	{
		$notificatorService = ManagerNotificatorServiceFactory::getService();
		$notificatorService->claimAcceptManager($claimEntity);
	}
}