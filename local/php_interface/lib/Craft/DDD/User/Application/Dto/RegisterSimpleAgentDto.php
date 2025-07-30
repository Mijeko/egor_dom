<?php

namespace Craft\DDD\User\Application\Dto;

final class RegisterSimpleAgentDto
{
	public function __construct(
		public string $phone,
		public string $email,
		public string $password,
	)
	{
	}
}