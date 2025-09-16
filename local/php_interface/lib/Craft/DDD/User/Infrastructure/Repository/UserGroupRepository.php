<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\UserGroupTable;
use Craft\DDD\User\Domain\Entity\GroupEntity;
use Craft\DDD\User\Domain\Repository\UserGroupRepositoryInterface;

class UserGroupRepository implements UserGroupRepositoryInterface
{
	public function findByUserId(int $userId): array
	{
		$result = [];

		$userGroupCollection = UserGroupTable::getList(['filter' => ['USER_ID' => $userId]])->fetchCollection();


		foreach($userGroupCollection as $group)
		{


			$result[] = GroupEntity::hydrate(
				$group->getGroupId(),
				$group->fillGroup()->fillName(),
				$group->fillGroup()->fillStringId(),
			);
		}

		return $result;
	}
}