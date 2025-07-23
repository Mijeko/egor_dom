<?php

namespace Craft\DDD\Claims\Infrastructure\Repository;

use Craft\DDD\Claims\Domain\Entity\ManagerEntity;
use Craft\DDD\Claims\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\Shared\Domain\ValueObject\AvailChannelContactValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ChannelEmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ChannelTgValueObject;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;

class OrmManagerRepository implements ManagerRepositoryInterface
{
	public function findAll(array $order = [], array $filter = []): array
	{
		$managers = [];


		$userList = CraftUserTable::getList(['order' => $order, 'filter' => $filter])->fetchCollection();

		foreach($userList as $user)
		{
			$managers[] = $this->hydrate($user);
		}

		return $managers;
	}

	public function hydrate(CraftUser $user): ManagerEntity
	{
		return new ManagerEntity(
			$user->getId(),
			$user->getName(),
			new AvailChannelContactValueObject(
				new ChannelEmailValueObject($user->getEmail()),
				new ChannelTgValueObject($user->getUfTgId())
			),
		);
	}
}