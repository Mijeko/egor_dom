<?php

namespace Craft\DDD\City\Application\Factory;

use Craft\DDD\City\Application\UseCase\StoreCurrentCityUseCase;
use Craft\DDD\City\Infrastructure\Factory\CurrentCityServiceFactory;
use Craft\DDD\City\Infrastructure\Repository\OrmCityRepository;

class StoreCurrentCityUseCaseFactory
{
	public static function getService(): StoreCurrentCityUseCase
	{
		return new StoreCurrentCityUseCase(
			new OrmCityRepository(),
			CurrentCityServiceFactory::getService(),
		);
	}
}