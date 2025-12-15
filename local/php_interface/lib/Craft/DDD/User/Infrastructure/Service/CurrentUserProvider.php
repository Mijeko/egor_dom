<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Craft\DDD\User\Application\Contract\CurrentUserProviderInterface;

class CurrentUserProvider implements CurrentUserProviderInterface
{

	public function getUserId(): ?int
	{
		global $USER;
		return $USER->GetID();
	}
}