<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Bitrix\Main\Security\Password;
use Craft\DDD\User\Application\Service\Interfaces\PasswordVerificator;

class PasswordVerificatorService implements PasswordVerificator
{
	public function verify($password, $hash): bool
	{
		return Password::equals($hash, $password);
	}
}