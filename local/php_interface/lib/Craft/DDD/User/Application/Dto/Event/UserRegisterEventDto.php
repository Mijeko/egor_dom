<?php

namespace Craft\DDD\User\Application\Dto\Event;

class UserRegisterEventDto
{
	public function __construct(
		public int    $userId,
		public string $phone,
	)
	{
	}
}