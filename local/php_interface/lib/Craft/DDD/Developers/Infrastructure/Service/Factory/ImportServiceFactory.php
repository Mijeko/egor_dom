<?php

namespace Craft\DDD\Developers\Infrastructure\Service\Factory;

use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Application\Service\Factory\BuildObjectServiceFactory;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;
use Craft\DDD\Developers\Infrastructure\Service\ImportService;

class ImportServiceFactory
{
	public static function getService(): ImportService
	{
		return new ImportService(
			new DeveloperService(
				new OrmDeveloperRepository(),
				new OrmBuildObjectRepository()
			),
			BuildObjectServiceFactory::createOnOrm(),
			new ApartmentService(
				new OrmApartmentRepository(),
				new BuildObjectService(
					new OrmBuildObjectRepository(),
					new DeveloperService(
						new OrmDeveloperRepository(),
						new OrmBuildObjectRepository(),
					)
				)
			),
		);
	}
}