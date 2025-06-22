<?php

namespace Craft\DDD\Objects\Application\Service;

use Craft\DDD\Objects\Domain\Entity\BuildObject;
use Craft\DDD\Objects\Domain\Repository\BuildObjectRepositoryInterface;

class BuildObjectService
{
	public function __construct(
		protected BuildObjectRepositoryInterface $repository,
	)
	{
	}

	public function findById(int $id): ?BuildObject
	{
		return $this->repository->findById($id);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		return $this->repository->findAll($order, $filter);
	}
}