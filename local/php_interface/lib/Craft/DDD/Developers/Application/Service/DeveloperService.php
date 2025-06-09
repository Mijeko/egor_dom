<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;

class DeveloperService
{
	public function __construct(
		protected DeveloperRepositoryInterface $repository,
	)
	{
	}

	public function findAll(array $criteria = []): array
	{
		return $this->repository->findAll($criteria);
	}
}