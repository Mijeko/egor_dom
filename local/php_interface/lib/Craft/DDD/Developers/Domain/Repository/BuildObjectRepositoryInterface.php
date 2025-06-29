<?php

namespace Craft\DDD\Developers\Domain\Repository;

use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;

interface BuildObjectRepositoryInterface
{
	public function findById(int $id): ?BuildObjectEntity;

	public function findByName(string $name): ?BuildObjectEntity;

	public function findAll(array $order = [], array $filter = []): array;
}