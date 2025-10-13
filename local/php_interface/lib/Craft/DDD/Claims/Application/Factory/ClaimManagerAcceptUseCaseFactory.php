<?php

namespace Craft\DDD\Claims\Application\Factory;

use Craft\DDD\Claims\Application\UseCase\ClaimAcceptDeveloperUseCase;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;

class ClaimManagerAcceptUseCaseFactory
{
	public static function getUseCase(): ClaimAcceptDeveloperUseCase
	{
		return new ClaimAcceptDeveloperUseCase(
			new OrmClaimRepository(),
		);
	}
}