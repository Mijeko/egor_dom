<?php

namespace Craft\DDD\Developers\Domain\Repository;

use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\Helper\Criteria;

interface BuildObjectRepositoryInterface
{
	public function create(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity;

	public function update(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity;

	public function findById(int $id): ?BuildObjectEntity;

	public function findByName(string $name): ?BuildObjectEntity;

	/**
	 * @param Criteria|null $criteria
	 * @return BuildObjectEntity[]
	 */
	public function findAll(Criteria $criteria = null): array;
}