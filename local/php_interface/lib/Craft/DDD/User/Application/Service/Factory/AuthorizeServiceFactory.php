<?php

namespace Craft\DDD\User\Application\Service\Factory;

use Craft\DDD\User\Application\Service\AuthorizeService;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;
use Craft\DDD\User\Infrastructure\Service\Authenticator;

class AuthorizeServiceFactory
{
	public static function getService(): AuthorizeService
	{
		return new AuthorizeService(
			new BxUserRepository(),
			new Authenticator()
		);
	}
}