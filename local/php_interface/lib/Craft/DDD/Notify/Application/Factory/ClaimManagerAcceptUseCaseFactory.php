<?php

namespace Craft\DDD\Notify\Application\Factory;

use Craft\DDD\Claims\Application\UseCase\ClaimAcceptDeveloperUseCase;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;
use Craft\DDD\Shared\Infrastructure\Service\EventManager;

class ClaimManagerAcceptUseCaseFactory
{
	public static function getUseCase(): ClaimAcceptDeveloperUseCase
	{
		return new ClaimAcceptDeveloperUseCase(
			new OrmClaimRepository(),
			new EventManager(),
		);
	}
}