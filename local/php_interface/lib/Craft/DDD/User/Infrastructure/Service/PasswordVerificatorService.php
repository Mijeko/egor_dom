<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Bitrix\Main\Security\Password;
use Craft\DDD\User\Application\Contract\PasswordVerificator;

class PasswordVerificatorService implements PasswordVerificator
{
	public function verify(string $password, string $hash): bool
	{
		return Password::equals($hash, $password);
	}
}