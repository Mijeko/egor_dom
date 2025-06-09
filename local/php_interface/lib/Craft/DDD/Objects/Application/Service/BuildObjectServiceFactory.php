<?php

namespace Craft\DDD\Objects\Application\Service;

use Craft\DDD\Objects\Infrastructure\Repository\OrmBuildObjectRepository;

class BuildObjectServiceFactory
{
	public static function create(): BuildObjectService
	{
		return new BuildObjectService(
			new OrmBuildObjectRepository()
		);
	}
}