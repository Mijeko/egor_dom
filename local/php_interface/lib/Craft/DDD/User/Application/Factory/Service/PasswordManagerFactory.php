<?php

namespace Craft\DDD\User\Application\Factory\Service;

use Craft\DDD\User\Application\Service\PasswordManager;
use Craft\DDD\User\Infrastructure\Service\PasswordVerificatorService;

class PasswordManagerFactory
{
	public static function getManager(): PasswordManager
	{
		return new PasswordManager(
			new PasswordVerificatorService()
		);
	}
}