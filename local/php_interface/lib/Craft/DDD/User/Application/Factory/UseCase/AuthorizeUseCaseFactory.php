<?php

namespace Craft\DDD\User\Application\Factory\UseCase;

use Craft\DDD\Shared\Infrastructure\Service\EventManagerInterface;
use Craft\DDD\User\Application\Factory\Service\PasswordManagerFactory;
use Craft\DDD\User\Application\UseCase\Signin\AuthorizeUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;
use Craft\DDD\User\Infrastructure\Service\Authenticator;

class AuthorizeUseCaseFactory
{
	public static function getService(): AuthorizeUseCase
	{
		return new AuthorizeUseCase(
			new BxUserRepository(),
			new Authenticator(),
			PasswordManagerFactory::getManager(),
			new EventManagerInterface()
		);
	}
}