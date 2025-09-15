<?php

namespace Craft\DDD\User\Application\Dto;

class CreateAgentRequestDto
{
	public function __construct(
		public string $name,
		public string $lastName,
		public string $secondName,
		public string $email,
		public string $phone,
		public int    $managerId
	)
	{
	}
}