<?php

namespace Craft\DDD\User\Application\Contract;

interface AuthenticatorInterface
{
	public function loginById(int $userId): bool;
}