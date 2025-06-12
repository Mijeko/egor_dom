<?php

namespace Craft\DDD\User\Application\Service\Factory;

use Craft\DDD\User\Application\Service\UpdateProfileService;
use Craft\DDD\User\Infrastructure\Repository\BxProfileRepository;

class UpdateProfileServiceFactory
{
	public static function create(): UpdateProfileService
	{
		return new UpdateProfileService(
			new BxProfileRepository()
		);
	}
}