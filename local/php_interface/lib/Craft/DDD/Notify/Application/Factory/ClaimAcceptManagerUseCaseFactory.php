<?php

namespace Craft\DDD\Notify\Application\Factory;

use Craft\DDD\Notify\Application\UseCase\ClaimAcceptManagerUseCase;

class ClaimAcceptManagerUseCaseFactory
{
	public static function getUseCase(): ClaimAcceptManagerUseCase
	{
		return new ClaimAcceptManagerUseCase();
	}
}