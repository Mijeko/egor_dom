<?php

namespace Craft\DDD\Referal\Application\Factory;

use Craft\DDD\Referal\Application\UseCase\InviteClientUseCase;
use Craft\DDD\Referal\Infrastructure\Repository\ReferralRepository;

class InviteClientUseCaseFactory
{
	public static function getUseCase(): InviteClientUseCase
	{
		return new InviteClientUseCase(
			new ReferralRepository()
		);
	}
}