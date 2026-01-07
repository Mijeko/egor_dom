<?php

namespace Craft\DDD\User\Application\Factory\UseCase;

use Craft\DDD\User\Application\UseCase\Register\RegisterUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;

class RegisterUseCaseFactory
{
	public static function getUseCase(): RegisterUseCase
	{
		return new RegisterUseCase(
			new AttachPhoneService(),
			new BxUserRepository(),
		);
	}
}