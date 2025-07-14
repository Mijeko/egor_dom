<?php

namespace Craft\DDD\City\Infrastructure\Events;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\City\Infrastructure\Factory\CurrentCityFactory;

class OnPageStartHandler
{
	public static function execute(): void
	{
//		$city = CurrentCityFactory::getService();
//		$city->currentOrDefault();

		Debug::dumpToFile(rand());
	}
}