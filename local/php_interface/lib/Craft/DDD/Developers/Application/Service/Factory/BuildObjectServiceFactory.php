<?php

namespace Craft\DDD\Developers\Application\Service\Factory;

use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Infrastructure\Repository\IblockBuildObjectOrmRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;

class BuildObjectServiceFactory
{
	public static function createOnOrm(): BuildObjectService
	{
		return new BuildObjectService(
			new OrmBuildObjectRepository()
		);
	}

	public static function createOnIblock(int $iblockId): BuildObjectService
	{
		return new BuildObjectService(
			new IblockBuildObjectOrmRepository($iblockId)
		);
	}
}