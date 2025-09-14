<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\Service\UserService;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;
use Craft\DDD\User\Infrastructure\Repository\UserGroupRepository;

class UserServiceFactory
{
	public static function getService(): UserService
	{
		return new UserService(
			new BxUserRepository(),
			new UserGroupRepository(),
		);
	}
}