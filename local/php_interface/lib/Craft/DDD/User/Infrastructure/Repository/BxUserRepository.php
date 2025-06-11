<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\User\Domain\Entity\User;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\Model\CraftUserTable;

class BxUserRepository implements UserRepositoryInterface
{

	public function findByPhoneNumber(string $phoneNumber): ?User
	{
		$query = CraftUserTable::getList([
			'filter'         => [
				CraftUserTable::F_PERSONAL_PHONE => $phoneNumber,
			],
			'select'         => [
				CraftUserTable::F_ID,
				CraftUserTable::F_LOGIN,
				CraftUserTable::F_EMAIL,
				CraftUserTable::F_PERSONAL_PHONE,
				CraftUserTable::F_PASSWORD,
			],
			'private_fields' => true,
		]);

		if($query->getSelectedRowsCount() != 1)
		{
			return null;
		}

		$bxUser = $query->fetchObject();

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