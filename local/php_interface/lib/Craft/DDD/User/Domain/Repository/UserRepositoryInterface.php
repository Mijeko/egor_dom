<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\User;

interface UserRepositoryInterface
{
	public function findByPhoneNumber(string $phoneNumber): ?User;

	public function findById(int $id): ?User;
}