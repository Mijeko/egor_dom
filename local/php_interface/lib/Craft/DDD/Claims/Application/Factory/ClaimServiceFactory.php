<?php

namespace Craft\DDD\Claims\Application\Factory;


use Craft\DDD\Claims\Application\Services\ClaimService;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;

class ClaimServiceFactory
{
	public static function getClaimService(): ClaimService
	{
		return new ClaimService(
			new OrmClaimRepository()
		);
	}
}