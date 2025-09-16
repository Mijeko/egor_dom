<?php

namespace Craft\DDD\Claims\Domain\Repository;

use Craft\DDD\Claims\Domain\Entity\ManagerEntity;
use Craft\Helper\Criteria;

interface ManagerRepositoryInterface
{

	/**
	 * @param Criteria|null $criteria
	 * @return ManagerEntity[]
	 */
	public function findAll(Criteria $criteria = null): array;

	public function findById(int $managerId): ?ManagerEntity;
}