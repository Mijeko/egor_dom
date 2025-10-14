<?php

namespace Craft\DDD\Developers\Application\Factory;

use Craft\DDD\Developers\Application\UseCase\DeveloperSettingsUpdateUseCase;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;

class DeveloperSettingsUpdateUseCaseFactory
{
	public static function getUseCase(): DeveloperSettingsUpdateUseCase
	{
		return new DeveloperSettingsUpdateUseCase(
			new OrmDeveloperRepository()
		);
	}
}