<?php

namespace Craft\DDD\Claims\Infrastructure\Repository;

use Bitrix\Main\UserGroupTable;
use Craft\DDD\Claims\Domain\Entity\ManagerEntity;
use Craft\DDD\Claims\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\Shared\Domain\ValueObject\AvailChannelContactValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ChannelEmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ChannelTgValueObject;
use Craft\Helper\Criteria;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;

class OrmManagerRepository implements ManagerRepositoryInterface
{
	public function findAll(Criteria $criteria = null): array
	{
		$managers = [];
		$userList = CraftUserTable::query();

		if($criteria)
		{
			$criteria->cache(['ttl' => 3600 * 48]);

			if($criteria->getFilter())
			{
				$userList->setFilter($criteria->getFilter());
			}

			if($criteria->getOrder())
			{
				$userList->setOrder($criteria->getOrder());
			}

			if($criteria->getSelect())
			{
				$userList->setSelect($criteria->getSelect());
			}
		}

		$userList = $userList->withManager()->fetchCollection();

		foreach($userList as $user)
		{
			$managers[] = $this->hydrate($user);
		}

		return $managers;
	}

	public function hydrate(CraftUser $user): ManagerEntity
	{
		return ManagerEntity::hydrate(
			$user->getId(),
			$user->getName(),
			new AvailChannelContactValueObject(
				new ChannelEmailValueObject(
					$user->getUfTgNotifyClaim(),
					$user->getEmail()
				),
				new ChannelTgValueObject(
					$user->getUfEmailNotifyClaim(),
					$user->getUfTgId()
				)
			),
		);
	}

	public function findById(int $managerId): ?ManagerEntity
	{
		$items = $this->findAll(Criteria::instance(
			[],
			[
				CraftUserTable::F_ID => $managerId,
			],
		));

		if(count($items) != 1)
		{
			return null;
		}


		return array_shift($items);
	}
}