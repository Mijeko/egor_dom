<?php

namespace Craft\User\Infrastructure\Repository;

use Bitrix\Main\SystemException;
use Bitrix\Main\UserPhoneAuthTable;
use Craft\User\Application\Entity\JUser;
use Craft\User\Domain\Interfaces\UserAuthRepositoryInterface;

class AuthUserRepository implements UserAuthRepositoryInterface
{
	public function exists(string $phone): bool
	{
		/* @phpstan-ignore class.notFound */
		$countAuth = UserPhoneAuthTable::getList([
			'filter' => [
				/* @phpstan-ignore class.notFound */
				'PHONE_NUMBER' => UserPhoneAuthTable::normalizePhoneNumber($phone),
			],
		])->getSelectedRowsCount();

		return $countAuth > 0;
	}

	public function create(JUser $user, string $phone): bool
	{
		$authPhone = UserPhoneAuthTable::createObject();
		$authPhone->setUserId($user->getId());
		$authPhone->setPhoneNumber($phone);
		$resultAuthPhone = $authPhone->save();

		if(!$resultAuthPhone->isSuccess())
		{
			throw new SystemException('User authorization-registration failed:' . implode('\n', $resultAuthPhone->getErrorMessages()));
		}


		return true;
	}
}