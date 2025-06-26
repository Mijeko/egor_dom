<?php

namespace Craft\DDD\Apartment\Infrastructure\Dto;

class ApartmentDto
{
	public function __construct(
		public string $id,
		public string $name,
		public string $price,
		public string $buildObjectId,
	)
	{
	}
}