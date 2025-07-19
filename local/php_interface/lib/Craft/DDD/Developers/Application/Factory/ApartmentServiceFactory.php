<?php

namespace Craft\DDD\Developers\Application\Factory;

use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Application\Factory\BuildObjectServiceFactory;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;

class ApartmentServiceFactory
{
	public static function createOnOrm(): ApartmentService
	{
		return new ApartmentService(
			new OrmApartmentRepository(),
			new OrmBuildObjectRepository()
		);
	}
}