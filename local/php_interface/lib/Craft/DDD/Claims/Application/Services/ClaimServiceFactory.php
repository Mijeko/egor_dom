<?php

namespace Craft\DDD\Claims\Application\Services;

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