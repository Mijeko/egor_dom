<?php

namespace Craft\DDD\User\Application\Service\Interfaces;

interface AuthenticatorInterface
{
	public function loginById(int $userId): bool;
}