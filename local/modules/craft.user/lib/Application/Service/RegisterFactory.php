<?php

namespace Craft\User\Application\Service;

use Craft\User\Infrastructure\Repository\AuthUserRepository;
use Craft\User\Infrastructure\Repository\UserRepository;
use Craft\User\Infrastructure\Repository\UserSocialIdentityRepository;

class RegisterFactory
{
	public static function create(): Register
	{
		return new Register(
			new UserRepository(),
			new AuthUserRepository(),
			new UserSocialIdentityRepository()
		);
	}
}