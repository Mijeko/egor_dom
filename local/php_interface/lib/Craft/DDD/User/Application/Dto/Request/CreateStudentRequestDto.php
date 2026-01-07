<?php

namespace Craft\DDD\User\Application\Dto\Request;

final class CreateStudentRequestDto
{
	public function __construct(
		public string $name,
		public string $lastName,
		public string $secondName,
		public string $phone,
		public string $email,
		public int    $managerId,
	)
	{
	}
}