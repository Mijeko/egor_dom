<?php

namespace Craft\DDD\City\Infrastructure\Factory;

use Craft\DDD\City\Infrastructure\Repository\OrmCityRepository;
use Craft\DDD\City\Infrastructure\Service\CookieCurrentCityStorage;
use Craft\DDD\City\Infrastructure\Service\CurrentCityService;

class CurrentCityFactory
{

	public static function getService(): CurrentCityService
	{
		return new CurrentCityService(
			new OrmCityRepository(),
			new CookieCurrentCityStorage(),
		);
	}
}