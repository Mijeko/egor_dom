<?php

namespace Craft\DDD\Developers\Application\Service\Factory;

use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;

class ApartmentServiceFactory
{
	public static function createOnOrm(): ApartmentService
	{
		return new ApartmentService(
			new OrmApartmentRepository(),
			BuildObjectServiceFactory::createOnOrm()
		);
	}
}