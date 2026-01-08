<?php

namespace Craft\DDD\Referal\Application\Factory;

use Craft\DDD\Referal\Application\Facade\StorageManager;
use Craft\DDD\Referal\Application\UseCase\AttachRefCodeToGuestUseCase;

class AttachRefCodeToGuestUseCaseFactory
{
	public static function getUseCase(): AttachRefCodeToGuestUseCase
	{
		return new AttachRefCodeToGuestUseCase(
			new StorageManager()
		);
	}
}