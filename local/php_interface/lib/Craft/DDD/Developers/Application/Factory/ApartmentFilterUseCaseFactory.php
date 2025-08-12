<?php

namespace Craft\DDD\Developers\Application\Factory;

use Craft\DDD\Developers\Application\UseCase\ApartmentFilterUseCase;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;

class ApartmentFilterUseCaseFactory
{
	public static function getService(): ApartmentFilterUseCase
	{
		return new ApartmentFilterUseCase(
			new OrmApartmentRepository(),
			new OrmBuildObjectRepository(),
			new ImageService()
		);
	}
}