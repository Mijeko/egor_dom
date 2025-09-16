<?php

namespace Craft\DDD\User\Application\UseCase;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\Shared\Infrastructure\Service\EventManager;
use Craft\DDD\User\Application\Service\Interfaces\AuthenticatorInterface;
use Craft\DDD\User\Application\Service\PasswordManager;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\DDD\User\Infrastructure\Events\AuthorizeEvent;

class AuthorizeUseCase
{


	public function __construct(
		protected UserRepositoryInterface $userRepository,
		protected AuthenticatorInterface  $authenticator,
		protected PasswordManager         $passwordManager,
		protected EventManager            $eventManager,
	)
	{
	}

	public function execute(string $phone, string $password): bool
	{
		$user = $this->userRepository->findByPhoneNumber(new PhoneValueObject($phone));
		if(!$user)
		{
			throw new \Exception('Пользователь не найден');
		}

		if(!$this->passwordManager->verifyPassword($password, $user->getPassword()->getValue()))
		{
			throw new \Exception('Пароль не верный');
		}

		$this->eventManager->dispatch(new AuthorizeEvent($user), AuthorizeEvent::EVENT_NAME);

		Debug::dumpToFile(rand());

		return $this->authenticator->loginById($user->getId());
	}
}