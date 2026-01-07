<?php

namespace Craft\DDD\User\Application\UseCase\Register;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\Shared\Infrastructure\Service\EventManagerInterface;
use Craft\DDD\User\Application\Contract\ExternalPhoneInterface;
use Craft\DDD\User\Application\Dto\Event\UserRegisterEventDto;
use Craft\DDD\User\Application\Dto\Request\RegisterRequestDto;
use Craft\DDD\User\Application\Event\UserRegisterEvent;
use Craft\DDD\User\Domain\Entity\UserEntity;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;

class RegisterUseCase
{

	public function __construct(
		private ExternalPhoneInterface  $externalPhone,
		private UserRepositoryInterface $userRepository,
		protected EventManagerInterface $eventManager,
	)
	{
	}

	public function execute(RegisterRequestDto $registerDto): void
	{
		if($this->isExistsUser($registerDto->phone))
		{
			throw new \Exception("Такой пользователь уже существует");
		}

		$user = UserEntity::register(
			new PhoneValueObject($registerDto->phone),
			new EmailValueObject($registerDto->email),
			new PasswordValueObject($registerDto->password)
		);

		$user = $this->userRepository->create($user);
		if(!$user)
		{
			throw new \Exception('Ошибка во время регистрации пользователя');
		}


		$resultAttach = $this->externalPhone->attach(
			$user->getId(),
			$user->getPhone()->getValue()
		);

		if(!$resultAttach)
		{
			throw new \Exception('Ошибка во время прикрепления телефона к пользователю');
		}

		$this->eventManager->dispatch(
			new UserRegisterEvent(
				new UserRegisterEventDto(
					$user->getId(),
					$user->getEmail()->getValue(),
				),
			),
			UserRegisterEvent::EVENT_NAME
		);
	}


	private function isExistsUser(string $phone): bool
	{
		if($this->externalPhone->isUse())
		{
			return $this->externalPhone->isExists($phone);
		}

		$user = $this->userRepository->findByPhoneNumber(new PhoneValueObject($phone));

		return $user !== null;
	}
}