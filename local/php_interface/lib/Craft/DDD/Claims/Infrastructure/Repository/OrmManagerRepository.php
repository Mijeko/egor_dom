<?php

namespace Craft\DDD\Claims\Infrastructure\Repository;

use Craft\DDD\Claims\Domain\Repository\ManagerRepositoryInterface;

class OrmManagerRepository implements ManagerRepositoryInterface
{
	public function findAll(array $order = [], array $filter = []): array
	{
		$managers = [];
		return $managers;
	}
}