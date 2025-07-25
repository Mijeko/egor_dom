<?php

namespace Craft\DDD\Claims\Infrastructure\Repository;

use Bitrix\Main\UserGroupTable;
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

		if(!defined('USER_GROUP_MANAGER_ID') || !USER_GROUP_MANAGER_ID)
		{
			return $managers;
		}

		$managersAssignGroup = UserGroupTable::getList([
			'filter' => [
				'=GROUP_ID' => USER_GROUP_MANAGER_ID,
			],
			'select' => [
				'USER_ID',
			],
			'cache'  => ['ttl' => 3600 * 48],
		])->fetchCollection();

		$userIdList = [];

		foreach($managersAssignGroup as $managerGroup)
		{
			$userIdList[] = $managerGroup->getUserId();
		}

		$userList = CraftUserTable::getList([
			'order'  => $order,
			'filter' => array_merge(
				['ID' => $userIdList],
				$filter
			),
			'cache'  => ['ttl' => 3600 * 48],
		])->fetchCollection();

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
}