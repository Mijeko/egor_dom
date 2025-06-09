<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;

class DeveloperServiceFactory
{
	public static function create(): DeveloperService
	{
		return new DeveloperService(
			new OrmDeveloperRepository()
		);
	}
}