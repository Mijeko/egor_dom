<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Craft\DDD\User\Application\Service\Interfaces\AutenficatorInterface;

class Autenficator implements AutenficatorInterface
{
	public function loginById(int $userId): bool
	{
		global $USER;
		return $USER->Authorize($userId, true);
	}
}