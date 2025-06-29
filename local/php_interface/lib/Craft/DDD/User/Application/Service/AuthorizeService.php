<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\User\Application\Service\Interfaces\AuthenticatorInterface;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;

class AuthorizeService
{


	public function __construct(
		protected UserRepositoryInterface $repository,
		protected AuthenticatorInterface  $authenticator,
	)
	{
	}

	public function execute(string $phone, string $password): bool
	{
		$user = $this->repository->findByPhoneNumber($phone);
		if(!$user)
		{
			throw new \Exception('Пользователь не найден');
		}

		if(!$user->validatePassword($password))
		{
			throw new \Exception('Пароль не верный');
		}


		return $this->authenticator->loginById($user->getId());
	}
}