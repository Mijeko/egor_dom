<?php

namespace Craft\DDD\Developers\Domain\Repository;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;

interface ApartmentRepositoryInterface
{
	public function findById(int $id): ?ApartmentEntity;

	public function findAll(array $order = [], array $filter = []): array;

	public function create(ApartmentEntity $apartment): ApartmentEntity;

	public function update(ApartmentEntity $apartment): ApartmentEntity;
}