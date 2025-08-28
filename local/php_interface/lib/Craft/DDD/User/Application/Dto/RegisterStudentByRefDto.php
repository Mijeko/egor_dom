<?php

namespace Craft\DDD\User\Application\Dto;

final class RegisterStudentByRefDto
{

	public function __construct(
		public string $phone,
		public string $email,
		public string $password,
		public string $referralCode,
	)
	{
	}
}