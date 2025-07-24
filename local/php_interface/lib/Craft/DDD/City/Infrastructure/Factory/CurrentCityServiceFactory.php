<?php

namespace Craft\DDD\City\Infrastructure\Factory;

use Craft\DDD\City\Infrastructure\Repository\OrmCityRepository;
use Craft\DDD\City\Infrastructure\Service\CurrentCityStorage\CookieCurrentCityStorage;
use Craft\DDD\City\Infrastructure\Service\CurrentCityService;
use Craft\DDD\City\Infrastructure\Service\CurrentCityStorage\SessionCurrentCityStorage;

class CurrentCityServiceFactory
{

	public static function getService(): CurrentCityService
	{
		return new CurrentCityService(
			new OrmCityRepository(),
			new SessionCurrentCityStorage(),
		//			new CookieCurrentCityStorage(),
		);
	}
}