<?php

namespace Craft\DDD\Shared\Presentation\Dto;

class PhoneDto
{
	public function __construct(
		public string  $phone,
		public ?string $label = null,
	)
	{
	}
}