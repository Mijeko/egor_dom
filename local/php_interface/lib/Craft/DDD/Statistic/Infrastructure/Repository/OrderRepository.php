<?php

namespace Craft\DDD\Statistic\Infrastructure\Repository;

use Craft\DDD\Statistic\Domain\Entity\OrderEntity;
use Craft\DDD\Statistic\Domain\Repository\OrderRepositoryInterface;
use Craft\Helper\Criteria;

class OrderRepository implements OrderRepositoryInterface
{
	public function findAll(Criteria $criteria = null): array
	{
		return [];
	}

	public function findById(int $orderId): ?OrderEntity
	{
		return null;
	}

}