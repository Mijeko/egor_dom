<?php

namespace Craft\DDD\User\Application\Dto;

class CurrentUserDto
{
	public function __construct(
		public int    $id,
		public string $email,
	)
	{
	}
}