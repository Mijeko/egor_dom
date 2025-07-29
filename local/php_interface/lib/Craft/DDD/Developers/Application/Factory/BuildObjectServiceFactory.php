<?php

namespace Craft\DDD\Developers\Application\Factory;

use Craft\DDD\City\Infrastructure\Factory\CurrentCityServiceFactory;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Infrastructure\Repository\IblockBuildObjectOrmRepository;
use Craft\DDD\Developers\Infrastructure\Repository\IblockDeveloperRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;

class BuildObjectServiceFactory
{
	public static function createOnOrm(): BuildObjectService
	{
		return new BuildObjectService(
			new OrmBuildObjectRepository(),
			new OrmDeveloperRepository(),
			new OrmApartmentRepository(),
			CurrentCityServiceFactory::getService(),
			new ImageService(),
		);
	}

	public static function createOnIblock(int $iblockId): BuildObjectService
	{
		return new BuildObjectService(
			new IblockBuildObjectOrmRepository($iblockId),
			new DeveloperService(
				new IblockDeveloperRepository($iblockId),
				new IblockBuildObjectOrmRepository($iblockId),
			),
			null,
			CurrentCityServiceFactory::getService(),
		);
	}
}