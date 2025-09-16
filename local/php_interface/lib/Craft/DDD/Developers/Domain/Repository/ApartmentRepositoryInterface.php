<?php

namespace Craft\DDD\Developers\Domain\Repository;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\Helper\Criteria;

interface ApartmentRepositoryInterface
{
	public function findById(int $id): ?ApartmentEntity;

	public function findAll(Criteria $criteria = null): array;

	public function create(ApartmentEntity $apartment): ApartmentEntity;

	public function update(ApartmentEntity $apartment): ApartmentEntity;

	public function findByExternalId(string $externalId): ?ApartmentEntity;

	public function countByBuildObjectId(int $buildObjectId): int;
}