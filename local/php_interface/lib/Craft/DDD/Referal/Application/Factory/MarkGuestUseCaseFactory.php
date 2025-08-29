<?php

namespace Craft\DDD\Referal\Application\Factory;

use Craft\DDD\Referal\Application\UseCase\MarkGuestUseCase;
use Craft\DDD\Referal\Infrastructure\Service\SessionStorageInfo;

class MarkGuestUseCaseFactory
{
	public static function getUseCase(): MarkGuestUseCase
	{
		return new MarkGuestUseCase(
			new SessionStorageInfo()
		);
	}
}