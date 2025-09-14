<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\Helper\Criteria;

interface ManagerRepositoryInterface
{

	/**
	 * @param Criteria|null $criteria
	 * @return ManagerEntity[]
	 */
	public function findAll(Criteria $criteria = null): array;

	public function findById(int $id): ?ManagerEntity;
}