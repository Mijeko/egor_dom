<?php

namespace Craft\DDD\Shared\Presentation\Dto;

class EmailDto
{
	public function __construct(
		public string  $email,
		public ?string $label = null,
	)
	{
	}
}