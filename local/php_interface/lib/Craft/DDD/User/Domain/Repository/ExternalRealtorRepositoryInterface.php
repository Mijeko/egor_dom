<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\ExternalRealtor;
use Craft\Helper\Criteria;

interface ExternalRealtorRepositoryInterface
{
	public function findById(int $id): ?ExternalRealtor;

	public function findAll(Criteria $criteria): array;
}