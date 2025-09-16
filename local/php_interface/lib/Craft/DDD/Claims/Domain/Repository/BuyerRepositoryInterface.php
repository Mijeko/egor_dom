<?php

namespace Craft\DDD\Claims\Domain\Repository;

use Craft\DDD\Claims\Domain\Entity\BuyerEntity;
use Craft\Helper\Criteria;

interface BuyerRepositoryInterface
{
	public function findById(int $id): ?BuyerEntity;

	public function findAll(Criteria $criteria): array;
}