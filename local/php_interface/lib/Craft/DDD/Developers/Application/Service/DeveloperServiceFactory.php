<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\Developers\Infrastructure\Repository\IblockDeveloperRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;

class DeveloperServiceFactory
{
	public static function createOnOrm(): DeveloperService
	{
		return new DeveloperService(
			new OrmDeveloperRepository()
		);
	}

	public static function createOnIblock(int $iblockId): DeveloperService
	{
		return new DeveloperService(
			new IblockDeveloperRepository($iblockId)
		);
	}
}