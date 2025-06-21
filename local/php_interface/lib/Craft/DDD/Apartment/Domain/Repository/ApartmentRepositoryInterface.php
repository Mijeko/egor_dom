<?php

namespace Craft\DDD\Apartment\Domain\Repository;

interface ApartmentRepositoryInterface
{
	public function findAll(array $filter = [], array $order = []): array;
}