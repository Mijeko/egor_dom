<?php

namespace Craft\DDD\Claims\Application\Factory;

use Craft\DDD\Claims\Application\UseCase\ClaimCreateUseCase;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;

class ClaimCreateUseCaseFactory
{
	public static function getService(): ClaimCreateUseCase
	{
		return new ClaimCreateUseCase(
			new OrmApartmentRepository(),
			new OrmClaimRepository(),
			new BxUserRepository()
		);
	}
}