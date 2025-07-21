<?php

namespace Craft\DDD\Developers\Application\Dto;

class ApartmentFilterDto
{

	public function __construct(
		public ?int   $buildObjectId,
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

	public function toArray(): array
	{
		return [
			'buildObjectId' => $this->buildObjectId,
			'price'         => [
				'min' => $this->minPrice,
				'max' => $this->maxPrice,
			],
			'bathroom'      => $this->bathroom,
			'renovation'    => $this->renovation,
			'floorsTotal'   => $this->floorsTotal,
			'roomsTotal'    => $this->roomsTotal,
			'floor'         => $this->floor,
		];
	}
}