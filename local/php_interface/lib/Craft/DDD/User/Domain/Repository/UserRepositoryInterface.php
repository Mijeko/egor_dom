<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\UserEntity;
use Craft\Helper\Criteria;

interface UserRepositoryInterface
{
	public function findByPhoneNumber(PhoneValueObject $phoneNumber): ?UserEntity;

	public function findById(int $id): ?UserEntity;

	public function findAll(Criteria $criteria): array;

	public function create(UserEntity $entity): ?UserEntity;
}