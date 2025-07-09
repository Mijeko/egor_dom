<?php

namespace Craft\DDD\Claims\Application\Factory;

use Craft\DDD\Claims\Application\UseCase\ClaimCreateUseCase;

class ClaimCreateUseCaseFactory
{
	public static function getService(): ClaimCreateUseCase
	{
		return new ClaimCreateUseCase();
	}
}