<?php

namespace Craft\DDD\Developers\Infrastructure\Service\Factory;

use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;
use Craft\DDD\Developers\Infrastructure\Service\ImportService;

class ImportServiceFactory
{
	public static function getService(): ImportService
	{
		return new ImportService(
			new OrmDeveloperRepository()
		);
	}
}