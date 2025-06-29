<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;

class BuildObjectService
{
	public function __construct(
		protected BuildObjectRepositoryInterface $repository,
	)
	{
	}

	public function findById(int $id): ?BuildObjectEntity
	{
		return $this->repository->findById($id);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		return $this->repository->findAll($order, $filter);
	}
}