<?php

namespace Craft\DDD\Developers\Application\Dto;

class ApartmentPreFilterDto
{
	public function __construct(
		public ?int   $minPrice,
		public ?int   $maxPrice,
		public ?array $bathroom,
		public ?array $renovation,
		public ?int   $floorsTotal,
		public ?int   $roomsTotal,
		public ?int   $floor,
	)
	{
	}


}