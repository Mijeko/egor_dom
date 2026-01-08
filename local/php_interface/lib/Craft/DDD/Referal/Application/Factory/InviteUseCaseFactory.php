<?php

namespace Craft\DDD\Referal\Application\Factory;

use Craft\DDD\Referal\Application\UseCase\InviteUseCase;
use Craft\DDD\Referal\Infrastructure\Repository\ReferralRepository;

class InviteUseCaseFactory
{
	public static function getUseCase(): InviteUseCase
	{
		return new InviteUseCase(
			new ReferralRepository()
		);
	}
}