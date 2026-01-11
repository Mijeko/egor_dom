<?php

namespace Craft\DDD\Statistic\Application\Factory;

use Craft\DDD\Statistic\Application\Services\ClaimStatService;
use Craft\DDD\Statistic\Infrastructure\Repository\OrderRepository;

class ClaimStatServiceFactory
{
	public static function getService(): ClaimStatService
	{
		return new ClaimStatService(
			new OrderRepository(),
		);
	}
}