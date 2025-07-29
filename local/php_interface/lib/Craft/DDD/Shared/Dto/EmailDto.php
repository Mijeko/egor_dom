<?php

namespace Craft\DDD\Shared\Dto;

class EmailDto
{
	public function __construct(
		public string  $email,
		public ?string $label = null,
	)
	{
	}
}