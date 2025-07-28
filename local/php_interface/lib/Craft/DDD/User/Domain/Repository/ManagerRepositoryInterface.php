<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\ManagerEntity;

interface ManagerRepositoryInterface
{

	/**
	 * @param array $order
	 * @param array $filter
	 * @return ManagerEntity[]
	 */
	public function findAll(array $order = [], array $filter = []): array;

	public function findById(int $id): ?ManagerEntity;
}