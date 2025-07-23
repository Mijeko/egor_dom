<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\Service\UpdateProfileService;
use Craft\DDD\User\Infrastructure\Repository\BxProfileRepository;

class UpdateProfileServiceFactory
{
	public static function getService(): UpdateProfileService
	{
		return new UpdateProfileService(
			new BxProfileRepository()
		);
	}
}