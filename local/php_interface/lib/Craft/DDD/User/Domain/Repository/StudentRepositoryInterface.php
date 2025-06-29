<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\StudentEntity;

interface StudentRepositoryInterface
{
	public function findById(int $id): ?StudentEntity;

	public function findByPhone(PhoneValueObject $phone): ?StudentEntity;

	public function create(StudentEntity $studentEntity): ?StudentEntity;
}