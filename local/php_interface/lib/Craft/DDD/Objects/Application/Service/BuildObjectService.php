<?php

namespace Craft\DDD\Objects\Application\Service;

use Craft\DDD\Objects\Domain\Repository\BuildObjectRepositoryInterface;

class BuildObjectService
{
	public function __construct(
		protected BuildObjectRepositoryInterface $repository,
	)
	{
	}

	public function findAll(array $criteria = []): array
	{
		return $this->repository->findAll($criteria);
	}
}