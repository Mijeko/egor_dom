<?php

namespace Craft\DDD\Referal\Application\Factory;

use Craft\DDD\Referal\Application\UseCase\InsertReferralMemberUseCase;
use Craft\DDD\Referal\Infrastructure\Repository\ReferralRepository;

class InsertReferralMemberFactory
{
	public static function getUseCase(): InsertReferralMemberUseCase
	{
		return new InsertReferralMemberUseCase(
			new ReferralRepository(),
		);
	}
}