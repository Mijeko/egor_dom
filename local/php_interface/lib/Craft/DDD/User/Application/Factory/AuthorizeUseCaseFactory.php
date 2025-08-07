<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\UseCase\AuthorizeUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;
use Craft\DDD\User\Infrastructure\Service\Authenticator;

class AuthorizeUseCaseFactory
{
	public static function getService(): AuthorizeUseCase
	{
		return new AuthorizeUseCase(
			new BxUserRepository(),
			new Authenticator(),
			PasswordManagerFactory::getManager()
		);
	}
}