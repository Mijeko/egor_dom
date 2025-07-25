<?php

namespace Craft\DDD\Developers\Infrastructure\Service\Factory;

use Craft\DDD\Developers\Application\Factory\DeveloperServiceFactory;
use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Application\Factory\BuildObjectServiceFactory;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Infrastructure\Service\ImportService;

class ImportServiceFactory
{
	public static function getService(): ImportService
	{
		return new ImportService(
			DeveloperServiceFactory::createOnOrm(),
			BuildObjectServiceFactory::createOnOrm(),
			new ApartmentService(
				new OrmApartmentRepository(),
				new OrmBuildObjectRepository()
			),
		);
	}
}