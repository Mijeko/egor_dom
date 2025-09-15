<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\StudentEntity;
use Craft\DDD\User\Domain\Repository\StudentRepositoryInterface;
use Craft\Helper\Criteria;
use Craft\Model\CraftUserTable;
use Craft\Model\EO_CraftUser;

class BxStudentRepository implements StudentRepositoryInterface
{

	public function findAll(Criteria $criteria = null): array
	{
		$result = [];

		$model = CraftUserTable::query()
			->withStudent();

		if($criteria)
		{
			if($criteria->getFilter())
			{
				$model->setFilter($criteria->getFilter());
			}

			if($criteria->getLimit())
			{
				$model->setLimit($criteria->getLimit());
			}

			if($criteria->getOrder())
			{
				$model->setOrder($criteria->getOrder());
			}
		}

		$model = $model->fetchCollection();

		foreach($model as $user)
		{
			try
			{
				$result[] = $this->hydrate($user);
			} catch(\Exception|\TypeError $exception)
			{
			}
		}

		return $result;
	}

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
			CraftUserTable::F_ACTIVE         => $studentEntity->getActive()->getValue(),
			CraftUserTable::F_LOGIN          => $studentEntity->getEmail()->getValue(),
			CraftUserTable::F_EMAIL          => $studentEntity->getEmail()->getValue(),
			CraftUserTable::F_PASSWORD       => $studentEntity->getPassword()->getValue(),
			CraftUserTable::F_PERSONAL_PHONE => $studentEntity->getPhone()->getValue(),
		]);

		if(!$resultId)
		{
			throw new \Exception($model->LAST_ERROR);
		}

		$studentEntity->refreshIdAfterRegistration($resultId);

		return $studentEntity;
	}

	private function hydrate(EO_CraftUser $student): StudentEntity
	{
		return StudentEntity::hydrate(
			$student->getId(),
			$student->getName(),
			$student->getLastName(),
			$student->getSecondName(),
			new PhoneValueObject($student->getPersonalMobile()),
			new EmailValueObject($student->getEmail()),
		);
	}

	public function update(StudentEntity $studentEntity): ?StudentEntity
	{
		return null;
	}
}