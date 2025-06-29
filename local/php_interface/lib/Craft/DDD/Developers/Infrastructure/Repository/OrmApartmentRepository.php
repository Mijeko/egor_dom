<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;

class OrmApartmentRepository implements ApartmentRepositoryInterface
{

	public function findAll(array $filter = [], array $order = []): array
	{
		return [];
	}

	public function create(ApartmentEntity $apartment): ApartmentEntity
	{
		return $apartment;
	}
}