<?php

namespace Craft\DDD\Developers\Application\Factory;

use Craft\DDD\City\Infrastructure\Repository\OrmCityRepository;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Infrastructure\Repository\IblockBuildObjectOrmRepository;
use Craft\DDD\Developers\Infrastructure\Repository\IblockDeveloperRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;

class DeveloperServiceFactory
{
	public static function createOnOrm(): DeveloperService
	{
		return new DeveloperService(
			new OrmDeveloperRepository(),
			new OrmBuildObjectRepository(),
			new OrmCityRepository(),
			new ImageService()
		);
	}

	public static function createOnIblock(int $iblockId): DeveloperService
	{
		return new DeveloperService(
			new IblockDeveloperRepository($iblockId),
			new IblockBuildObjectOrmRepository($iblockId)
		);
	}
}