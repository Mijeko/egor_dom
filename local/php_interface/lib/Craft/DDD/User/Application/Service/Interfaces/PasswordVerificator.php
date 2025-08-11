<?php

namespace Craft\DDD\User\Application\Service\Interfaces;

interface PasswordVerificator
{
	public function verify(string $password, string $hash): bool;
}