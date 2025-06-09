<?php

namespace Craft\DDD\Objects\Domain\Repository;

interface BuildObjectRepositoryInterface
{
	public function findAll(array $criteria = []): array;
}