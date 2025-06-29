<?php

namespace Craft\DDD\Developers\Domain\Repository;

interface ApartmentRepositoryInterface
{
	public function findAll(array $filter = [], array $order = []): array;
}