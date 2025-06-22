<?php

namespace Craft\DDD\Objects\Application\Service;

use Craft\DDD\Objects\Infrastructure\Repository\IblockBuildObjectOrmRepository;
use Craft\DDD\Objects\Infrastructure\Repository\OrmBuildObjectRepository;

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