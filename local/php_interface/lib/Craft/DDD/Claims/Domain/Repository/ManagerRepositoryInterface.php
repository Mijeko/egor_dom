<?php

namespace Craft\DDD\Claims\Domain\Repository;

use Craft\DDD\Claims\Domain\Entity\ManagerEntity;

interface ManagerRepositoryInterface
{

	/**
	 * @return ManagerEntity[]
	 */
	public function findAll(array $order = [], array $filter = []): array;
}