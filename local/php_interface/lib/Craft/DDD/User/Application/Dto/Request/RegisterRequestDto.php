<?php

namespace Craft\DDD\User\Application\Dto\Request;

final class RegisterRequestDto
{
	public function __construct(
		public string $email,
		public string $phone,
		public string $password,
	)
	{
	}
}