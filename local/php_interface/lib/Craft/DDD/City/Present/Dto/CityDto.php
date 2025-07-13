<?php

namespace Craft\DDD\City\Present\Dto;

use Craft\DDD\City\Domain\Entity\CityEntity;

class CityDto
{
	public function __construct(
		public int    $id,
		public string $name,
	)
	{
	}

	public static function fromEntity(CityEntity $entity): static
	{
		return new static(
			$entity->getId(),
			$entity->getName(),
		);
	}
}