<?php

namespace Craft\DDD\User\Application\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\User\Domain\Entity\GroupEntity;
use Craft\DDD\User\Domain\Entity\UserEntity;
use Craft\DDD\User\Domain\Repository\UserGroupRepositoryInterface;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\Helper\Criteria;
use Craft\Model\CraftUserTable;

class UserService
{
	public function __construct(
		protected UserRepositoryInterface      $userRepository,
		protected UserGroupRepositoryInterface $userGroupRepository,
	)
	{
	}


	public function findAll(Criteria $criteria): array
	{
		$list = $this->userRepository->findAll($criteria);


		$groups = array_reduce($list, function(array $init, UserEntity $userEntity) {
			return array_merge($init, $this->userGroupRepository->findByUserId($userEntity->getId()));
		}, []);


		$list = array_map(function(UserEntity $entity) use ($groups) {

			foreach($entity->getGroupIdList() as $groupId)
			{
				$group = array_filter($groups, function(GroupEntity $group) use ($groupId) {
					return $group->getId() == $groupId;
				});

				if(count($group) === 1)
				{
					$group = array_shift($group);
					if($group)
					{
						$entity->addGroup($group);
					}
				}
			}

			return $entity;

		}, $list);


		return $list;
	}

	public function findById(int $id): ?UserEntity
	{
		$users = $this->findAll(Criteria::instance()->filter([
			CraftUserTable::F_ID => $id,
		]));

		if(count($users) !== 1)
		{
			return null;
		}

		return array_shift($users);
	}

}