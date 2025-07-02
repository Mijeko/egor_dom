<?php

namespace Craft\DDD\Developers\Infrastructure\Dto;

class ApartmentDto
{
	public function __construct(
		public ?string $id,
		public ?string $name,
		public ?string $price,
		public ?string $buildObjectId,
	)
	{
	}
}