<?php

namespace Craft\DDD\City\Domain\Repository;

use Craft\DDD\City\Domain\Entity\CityEntity;

interface CityRepositoryInterface
{
	public function create(CityEntity $city): ?CityEntity;

	public function findById(int $id): ?CityEntity;

	public function findAll(array $order = [], array $filter = []): array;

	public function findDefault(): CityEntity;
}