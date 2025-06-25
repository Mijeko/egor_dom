<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\User\Domain\Entity\User;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;

class BxUserRepository implements UserRepositoryInterface
{

	protected function prepareGetList(array $filter, array $select = []): array
	{
		return [
			'filter'         => $filter,
			'select'         => array_merge(
				[
					CraftUserTable::F_ID,
					CraftUserTable::F_LOGIN,
					CraftUserTable::F_EMAIL,
					CraftUserTable::F_PERSONAL_PHONE,
					CraftUserTable::F_PASSWORD,
				],
				$select
			),
			'private_fields' => true,
		];
	}

	public function findById(int $id): ?User
	{
		$query = CraftUserTable::getList($this->prepareGetList(
			[
				CraftUserTable::F_ID => $id,
			]
		));

		if($query->getSelectedRowsCount() != 1)
		{
			return null;
		}

		$bxUser = $query->fetchObject();

		return $this->hydrateElement($bxUser);
	}

	public function findByPhoneNumber(string $phoneNumber): ?User
	{
		$query = CraftUserTable::getList($this->prepareGetList(
			[
				CraftUserTable::F_PERSONAL_PHONE => $phoneNumber,
			]
		));

		if($query->getSelectedRowsCount() != 1)
		{
			return null;
		}

		$bxUser = $query->fetchObject();

		return $this->hydrateElement($bxUser);

	}

	public function hydrateElement(CraftUser $bxUser): User
	{
		$user = new User(
			$bxUser[CraftUserTable::F_ID],
			$bxUser[CraftUserTable::F_LOGIN],
			$bxUser[CraftUserTable::F_PERSONAL_PHONE],
			$bxUser[CraftUserTable::F_EMAIL],
			$bxUser[CraftUserTable::F_PASSWORD],
		);

		return $user;
	}
}