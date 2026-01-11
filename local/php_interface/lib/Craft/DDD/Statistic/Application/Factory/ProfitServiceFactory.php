<?php

namespace Craft\DDD\Statistic\Application\Factory;

use Craft\DDD\Statistic\Application\Services\RewardService;
use Craft\DDD\Statistic\Infrastructure\Repository\OrderRepository;

class ProfitServiceFactory
{
	public static function getService(): RewardService
	{
		return new RewardService(
			new OrderRepository(),
		);
	}
}