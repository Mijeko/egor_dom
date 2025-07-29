<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;

class BxManagerRepository implements ManagerRepositoryInterface
{

	public function findById(int $id): ?ManagerEntity
	{

		$managerList = $this->findAll([], [
			CraftUserTable::F_ID => $id,
		]);

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

	public function findAll(array $order = [], array $filter = []): array
	{

		$result = [];

		$model = CraftUserTable::getList([
			'order'  => $order,
			'filter' => $filter,
		])->fetchCollection();


		foreach($model as $user)
		{
			$result[] = $this->hydrate($user);
		}

		return $result;
	}

	private function hydrate(CraftUser $craftUser): ManagerEntity
	{
		return new ManagerEntity(
			$craftUser->getId(),
			$craftUser->getName(),
			$craftUser->getLastName(),
			$craftUser->getSecondName(),
			[
				new PhoneValueObject($craftUser->getPersonalPhone()),
			],
			ImageValueObject::fromId(
				$craftUser->getPersonalPhoto()
			)
		);
	}
}