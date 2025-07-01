<?php

namespace Craft\DDD\Developers\Application\Service\Factory;

use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Infrastructure\Repository\IblockBuildObjectOrmRepository;
use Craft\DDD\Developers\Infrastructure\Repository\IblockDeveloperRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;

class DeveloperServiceFactory
{
	public static function createOnOrm(): DeveloperService
	{
		return new DeveloperService(
			new OrmDeveloperRepository(),
			new OrmBuildObjectRepository(),
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