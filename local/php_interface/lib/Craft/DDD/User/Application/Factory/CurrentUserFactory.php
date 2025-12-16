<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\DDD\User\Application\Service\CurrentUser;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;
use Craft\DDD\User\Infrastructure\Service\CurrentUserProvider;

class CurrentUserFactory
{
	public static function getService(): CurrentUser
	{
		return new CurrentUser(
			new CurrentUserProvider(),
			new BxUserRepository(),
			new ImageService(),
		);
	}
}