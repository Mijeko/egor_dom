<?php

namespace Craft\DDD\Claims\Application\Factory;

use Craft\DDD\Claims\Application\UseCase\ShortOrderInfoUseCase;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;

class ShortOrderInfoUseCaseFactory
{
	public static function getUseCase(): ShortOrderInfoUseCase
	{
		return new ShortOrderInfoUseCase(
			new OrmClaimRepository(),
			new OrmApartmentRepository(),
		);
	}
}