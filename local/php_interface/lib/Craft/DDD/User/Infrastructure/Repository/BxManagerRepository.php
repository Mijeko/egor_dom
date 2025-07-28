<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;

class BxManagerRepository implements ManagerRepositoryInterface
{

	public function findById(int $id): ?ManagerEntity
	{
		return null;
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		return [];
	}
}