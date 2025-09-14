<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\Helper\Criteria;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;
use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;

class BxManagerRepository implements ManagerRepositoryInterface
{

	public function findById(int $id): ?ManagerEntity
	{
		$managerList = $this->findAll();

		if(count($managerList) !== 1)
		{
			return null;
		}

		$manager = array_shift($managerList);

		if(!$manager)
		{
			return null;
		}

		return $manager;

	}

	public function findAll(Criteria $criteria = null): array
	{
		$result = [];

		$model = CraftUserTable::query()
			->withManager();

		if($criteria)
		{
			if($criteria->getFilter())
			{
				$model->addFilter($criteria->getFilter());
			}

			if($criteria->getLimit())
			{
				$model->addLimit($criteria->getLimit());
			}

			if($criteria->getOrder())
			{
				$model->addOrder($criteria->getOrder());
			}
		}

		$model = $model->fetchCollection();

		foreach($model as $user)
		{
			$result[] = $this->hydrate($user);
		}

		return $result;
	}

	private function hydrate(CraftUser $craftUser): ManagerEntity
	{
		return ManagerEntity::hydrate(
		// @phpstan-ignore method.notFound
			$craftUser->getId(),
			// @phpstan-ignore method.notFound
			$craftUser->getName(),
			// @phpstan-ignore method.notFound
			$craftUser->getLastName(),
			// @phpstan-ignore method.notFound
			$craftUser->getSecondName(),
			// @phpstan-ignore method.notFound
			new EmailValueObject($craftUser->getEmail()),
			// @phpstan-ignore method.notFound
			new PhoneValueObject($craftUser->fillPersonalMobile()),
			[
				new EmailValueObject(
				// @phpstan-ignore method.notFound
					$craftUser->getEmail()
				),
				new EmailValueObject(
				// @phpstan-ignore method.notFound
					$craftUser->fillUfEmailTwo()
				),
			],
			// @phpstan-ignore method.notFound
			[
				new PhoneValueObject(
				// @phpstan-ignore method.notFound
					$craftUser->fillPersonalPhone()
				),
				new PhoneValueObject(
				// @phpstan-ignore method.notFound
					$craftUser->fillUfPhoneTwo()
				),
			],
			$craftUser->getPersonalPhoto(),
		);
	}
}