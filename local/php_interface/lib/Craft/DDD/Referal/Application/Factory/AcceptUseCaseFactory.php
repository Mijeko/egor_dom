<?php

namespace Craft\DDD\Referal\Application\Factory;

use Craft\DDD\Referal\Application\UseCase\AcceptUseCase;

class AcceptUseCaseFactory
{
	public static function getUseCase(): AcceptUseCase
	{
		return new AcceptUseCase();
	}
}