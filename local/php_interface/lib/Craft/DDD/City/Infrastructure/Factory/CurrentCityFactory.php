<?php

namespace Craft\DDD\City\Infrastructure\Factory;

use Craft\DDD\City\Infrastructure\Repository\OrmCityRepository;
use Craft\DDD\City\Infrastructure\Service\CookieCurrentCityStorage;
use Craft\DDD\City\Infrastructure\Service\CurrentCity;

class CurrentCityFactory
{

	public static function getService(): CurrentCity
	{
		return new CurrentCity(
			new OrmCityRepository(),
			new CookieCurrentCityStorage(),
		);
	}
}