<?php

namespace Craft\DDD\Objects\Infrastructure\Dto;

use Craft\DDD\Objects\Domain\Entity\BuildObject;

class BuildObjectFrontDto
{
	public function __construct(
		public int    $id,
		public string $name,
		public ?array $picture = null
	)
	{
	}

	public static function fromModel(BuildObject $developer): static
	{
		$file = \CFile::GetFileArray($developer->getPictureId());

		if(!$file)
		{
			$file = [];
		}

		return new static(
			$developer->getId(),
			$developer->getName(),
			$file
		);
	}
}