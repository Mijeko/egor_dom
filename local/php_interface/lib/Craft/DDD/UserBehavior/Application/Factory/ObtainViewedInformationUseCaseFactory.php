<?php

namespace Craft\DDD\UserBehavior\Application\Factory;

use Craft\DDD\UserBehavior\Application\UseCase\ObtainViewedInformationUseCase;
use Craft\DDD\UserBehavior\Infrastructure\Repository\ProductViewedRepository;

class ObtainViewedInformationUseCaseFactory
{
	public static function getUseCase(): ObtainViewedInformationUseCase
	{
		return new ObtainViewedInformationUseCase(
			new ProductViewedRepository(),
		);
	}
}