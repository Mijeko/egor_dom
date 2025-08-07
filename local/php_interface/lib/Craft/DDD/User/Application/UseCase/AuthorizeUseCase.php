<?php

namespace Craft\DDD\User\Application\UseCase;

use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Application\Service\Interfaces\AuthenticatorInterface;
use Craft\DDD\User\Application\Service\PasswordManager;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;

class AuthorizeUseCase
{


	public function __construct(
		protected UserRepositoryInterface $repository,
		protected AuthenticatorInterface  $authenticator,
		protected PasswordManager         $passwordManager,
	)
	{
	}

	public function execute(string $phone, string $password): bool
	{
		$user = $this->repository->findByPhoneNumber(new PhoneValueObject($phone));
		if(!$user)
		{
			throw new \Exception('Пользователь не найден');
		}

		if(!$this->passwordManager->verifyPassword($password, $user->getPassword()))
		{
			throw new \Exception('Пароль не верный');
		}


		return $this->authenticator->loginById($user->getId());
	}
}