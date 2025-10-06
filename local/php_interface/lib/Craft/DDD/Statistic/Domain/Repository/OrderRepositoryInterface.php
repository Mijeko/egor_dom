<?php

namespace Craft\DDD\Statistic\Domain\Repository;

use Craft\DDD\Statistic\Domain\Entity\OrderEntity;
use Craft\Helper\Criteria;

interface OrderRepositoryInterface
{
	public function findAll(Criteria $criteria = null): array;

	public function findById(int $orderId): ?OrderEntity;
}