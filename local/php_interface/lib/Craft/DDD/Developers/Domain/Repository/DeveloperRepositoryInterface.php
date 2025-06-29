<?php

namespace Craft\DDD\Developers\Domain\Repository;

use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;

interface DeveloperRepositoryInterface
{
	public function findById(int $id): ?DeveloperEntity;

	public function findAll(array $order = [], array $filter = []): array;
}