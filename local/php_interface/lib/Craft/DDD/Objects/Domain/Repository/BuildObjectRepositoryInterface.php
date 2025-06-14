<?php

namespace Craft\DDD\Objects\Domain\Repository;

use Craft\DDD\Objects\Domain\Entity\BuildObject;

interface BuildObjectRepositoryInterface
{
	public function findById(int $id): ?BuildObject;

	public function findAll(array $order = [], array $filter = []): array;
}