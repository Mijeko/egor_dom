<?php

namespace Craft\DDD\User\Domain\Repository;

interface UserGroupRepositoryInterface
{
	public function findByUserId(int $userId): array;
}