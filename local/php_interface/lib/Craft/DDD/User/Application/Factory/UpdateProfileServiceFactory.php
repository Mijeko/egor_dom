<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\UseCase\UpdateProfileUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxProfileRepository;

class UpdateProfileServiceFactory
{
	public static function getService(): UpdateProfileUseCase
	{
		return new UpdateProfileUseCase(
			new BxProfileRepository()
		);
	}
}