<?php

namespace Craft\DDD\Statistic\Application\Factory;

use Craft\DDD\Statistic\Application\Services\ProfitService;
use Craft\DDD\Statistic\Infrastructure\Repository\OrderRepository;

class ProfitServiceFactory
{
	public static function getService(): ProfitService
	{
		return new ProfitService(
			new OrderRepository(),
		);
	}
}