<?php

namespace Craft\DDD\Referal\Application\Factory;

use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;
use Craft\DDD\Referal\Application\Service\ReferralInformationService;
use Craft\DDD\Referal\Infrastructure\Repository\ReferralRepository;

class ReferralInformationServiceFactory
{
	public static function getService(): ReferralInformationService
	{
		return new ReferralInformationService(
			new ReferralRepository(),
			new OrmClaimRepository(),
		);
	}
}