<?php

namespace Craft\DDD\User\Application\Contract;

interface PasswordVerificator
{
	public function verify(string $password, string $hash): bool;
}