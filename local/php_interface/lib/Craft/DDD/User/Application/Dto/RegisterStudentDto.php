<?php

namespace Craft\DDD\User\Application\Dto;

class RegisterStudentDto
{
	public function __construct(
		public string $phone,
		public string $email,
		public string $password,
	)
	{
	}
}