<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\User\Application\Contract\PasswordVerificator;

class PasswordManager
{

	public function __construct(
		protected PasswordVerificator $verificator
	)
	{
	}

	public function verifyPassword(string$password, string $hash): bool
	{
		return $this->verificator->verify($password, $hash);
	}
}