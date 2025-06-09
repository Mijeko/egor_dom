<?php

namespace Craft\DDD\Developers\Domain\Repository;

interface DeveloperRepositoryInterface
{
	public function findAll(array $criteria = []): array;
}