<?php

namespace Craft\DDD\Claims\Application\Factory;


use Craft\DDD\Claims\Application\Services\ClaimService;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;

class ClaimServiceFactory
{
	public static function getClaimService(): ClaimService
	{
		return new ClaimService(
			new OrmClaimRepository(),
			new OrmApartmentRepository(),
			new BxUserRepository(),
			new OrmBuildObjectRepository(),
			ClaimCreateUseCaseFactory::getService(),
			ManagerNotificatorServiceFactory::getService()
		);
	}
}