<?php

namespace Craft\DDD\City\Infrastructure\Events;

use Craft\DDD\City\Infrastructure\Factory\CurrentCityServiceFactory;

class OnPageStartHandler
{
	public static function execute(): void
	{
		$city = CurrentCityServiceFactory::getService();
		$city->currentOrDefault();
	}
}