<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Craft\DDD\User\Application\Service\Interfaces\AuthenticatorInterface;

class Authenticator implements AuthenticatorInterface
{
	public function loginById(int $userId): bool
	{
		global $USER;
		return $USER->Authorize($userId, true);
	}
}