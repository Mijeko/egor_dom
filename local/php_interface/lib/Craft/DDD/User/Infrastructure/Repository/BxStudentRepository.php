<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\StudentEntity;
use Craft\DDD\User\Domain\Repository\StudentRepositoryInterface;
use Craft\Model\CraftUserTable;

class BxStudentRepository implements StudentRepositoryInterface
{

	public function findById(int $id): ?StudentEntity
	{
		return null;
	}

	public function findByPhone(PhoneValueObject $phone): ?StudentEntity
	{
		return null;
	}

	public function create(StudentEntity $studentEntity): ?StudentEntity
	{
		$model = new \CUser();


		$resultId = $model->Add([
			CraftUserTable::F_EMAIL          => $studentEntity->getEmail()->getValue(),
			CraftUserTable::F_PASSWORD       => $studentEntity->getPassword()->getValue(),
			CraftUserTable::F_PERSONAL_PHONE => $studentEntity->getPhone()->getValue(),
		]);

		if($resultId)
		{
			$studentEntity->refreshIdAfterRegistration($resultId);
		}

		throw new \Exception($model->LAST_ERROR);
	}
}