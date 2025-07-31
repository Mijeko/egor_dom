<?php

namespace Craft\DDD\Shared\Presentation\Dto;

final class PhoneDto
{
	public function __construct(
		public ?string $phone,
		public ?string $label = null,
	)
	{
	}
}