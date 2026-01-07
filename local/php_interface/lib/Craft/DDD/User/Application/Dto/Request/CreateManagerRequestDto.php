<?php

namespace Craft\DDD\User\Application\Dto\Request;

final class CreateManagerRequestDto
{
	public function __construct(
		public string  $email,
		public string  $phone,
		public ?string $name,
		public ?string $lastName,
		public ?string $secondName,
	)
	{
	}
}