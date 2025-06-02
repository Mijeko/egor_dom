<?php

namespace Craft\User\Infrastructure\Repository;

use Bitrix\Main\SystemException;
use Craft\User\Application\Entity\JUser;
use Craft\User\Application\Entity\JUserTable;
use Craft\User\Domain\Dto\UserRegisterDto;
use Craft\User\Domain\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
	public function findByEmail(string $email): ?JUser
	{
		return null;
	}

	public function findByPhone(string $phone): ?JUser
	{
		return null;
	}

	public function findById(int $id): ?JUser
	{
		return null;
	}

	public function existByPhone(string $phone): bool
	{
		return false;
	}

	public function existByEmail(string $email): bool
	{
		return false;
	}

	public function createUser(string $email, string $phone, string $password, ?UserRegisterDto $additionalParams = null): ?JUser
	{
		if($additionalParams)
		{
			$additionalParams = $additionalParams->toArray();
		} else
		{
			$additionalParams = [];
		}

		$user = new \CUser();
		$userId = $user->Add(array_merge([
			'LOGIN'            => $email,
			'EMAIL'            => $email,
			'PERSONAL_PHONE'   => $phone,
			'PASSWORD'         => $password,
			'CONFIRM_PASSWORD' => $password,
		], $additionalParams));

		if(!$userId)
		{
			throw new SystemException('User registration failed: ' . $user->LAST_ERROR);
		}

		return JUserTable::getByPrimary($userId)->fetchObject();
	}
}