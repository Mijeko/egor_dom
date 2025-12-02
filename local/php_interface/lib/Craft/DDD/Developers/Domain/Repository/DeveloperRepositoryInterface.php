<?php

namespace Craft\DDD\Developers\Domain\Repository;

use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\Helper\Criteria;

interface DeveloperRepositoryInterface
{
	public function update(DeveloperEntity $developer): ?DeveloperEntity;

	public function findById(int $id): ?DeveloperEntity;

	public function findAll(Criteria $criteria = null): array;
}