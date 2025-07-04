<?php

namespace Craft\DDD\Developers\Domain\Repository;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;

interface ApartmentRepositoryInterface
{
	public function findAll(array $order = [], array $filter = []): array;

	public function create(ApartmentEntity $apartment): ApartmentEntity;
}