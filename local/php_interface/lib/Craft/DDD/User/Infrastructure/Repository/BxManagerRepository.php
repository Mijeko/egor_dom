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
	public function create(ManagerEntity $manager): ?ManagerEntity
	{
		$model = new \CUser();

		$result = $model->Add([
			CraftUserTable::F_LOGIN           => $manager->getEmail()->getValue(),
			CraftUserTable::F_EMAIL           => $manager->getEmail()->getValue(),
			CraftUserTable::F_PERSONAL_MOBILE => $manager->getPhone()->getValue(),
			CraftUserTable::F_NAME            => $manager->getName(),
			CraftUserTable::F_LAST_NAME       => $manager->getLastName(),
			CraftUserTable::F_PASSWORD        => $manager->getPassword(),
		]);

		if($result)
		{
			$manager->refreshId($result);
			return $manager;
		}

		throw new \Exception($model->LAST_ERROR);

	}

	public function findById(int $id): ?ManagerEntity
	{
		$managerList = $this->findAll(Criteria::instance()->filter([
			CraftUserTable::F_ID => $id,
		]));

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
					mb_strlen($craftUser->fillPersonalPhone()) > 0 ? $craftUser->fillPersonalPhone() : null
				),
				new PhoneValueObject(
				// @phpstan-ignore method.notFound
					mb_strlen($craftUser->fillUfPhoneTwo()) > 0 ? $craftUser->fillUfPhoneTwo() : null
				),
			],
			$craftUser->getPersonalPhoto(),
		);
	}
}