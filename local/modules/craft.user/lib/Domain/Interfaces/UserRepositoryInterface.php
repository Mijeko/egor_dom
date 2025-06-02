<?php

namespace Craft\User\Domain\Interfaces;

use Craft\User\Application\Entity\JUser;
use Craft\User\Domain\Dto\UserRegisterDto;

interface UserRepositoryInterface
{
	public function createUser(string $email, string $phone, string $password, ?UserRegisterDto $additionalParams = null): ?JUser;

	public function findByEmail(string $email): ?JUser;

	public function findByPhone(string $phone): ?JUser;

	public function findById(int $id): ?JUser;

	public function existByPhone(string $phone): bool;

	public function existByEmail(string $email): bool;
}