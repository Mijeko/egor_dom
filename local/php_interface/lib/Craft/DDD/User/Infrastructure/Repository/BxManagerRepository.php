<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;

class BxManagerRepository implements ManagerRepositoryInterface
{
	public function findAll(array $order = [], array $filter = []): array
	{
		return [];
	}
}