<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\ExternalRealtorEntity;
use Craft\Helper\Criteria;

interface ExternalRealtorRepositoryInterface
{
	public function findById(int $id): ?ExternalRealtorEntity;

	public function findAll(Criteria $criteria): array;
}