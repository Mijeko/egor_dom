<?php

namespace Craft\DDD\Claims\Application\Factory;

use Craft\DDD\Claims\Application\UseCase\ShortOrderInfoUseCase;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;

class ShortOrderInfoUseCaseFactory
{
	public static function getUseCase(): ShortOrderInfoUseCase
	{
		return new ShortOrderInfoUseCase(
			new OrmClaimRepository()
		);
	}
}