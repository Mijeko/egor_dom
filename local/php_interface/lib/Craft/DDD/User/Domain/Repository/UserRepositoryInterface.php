<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\UserEntity;

interface UserRepositoryInterface
{
	public function findByPhoneNumber(string $phoneNumber): ?UserEntity;

	public function findById(int $id): ?UserEntity;
}