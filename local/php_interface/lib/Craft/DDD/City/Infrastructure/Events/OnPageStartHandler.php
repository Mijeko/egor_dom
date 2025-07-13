<?php

namespace Craft\DDD\City\Infrastructure\Events;

use Craft\DDD\City\Infrastructure\Factory\CurrentCityFactory;

class OnPageStartHandler
{
	public static function execute()
	{
		$city = CurrentCityFactory::getService();
		$city->current();
	}
}