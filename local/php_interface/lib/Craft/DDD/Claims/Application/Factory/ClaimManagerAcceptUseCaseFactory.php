<?php

namespace Craft\DDD\Claims\Application\Factory;

use Craft\DDD\Claims\Application\UseCase\ClaimManagerAcceptUseCase;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;

class ClaimManagerAcceptUseCaseFactory
{
	public static function getUseCase(): ClaimManagerAcceptUseCase
	{
		return new ClaimManagerAcceptUseCase(
			new OrmClaimRepository(),
		);
	}
}