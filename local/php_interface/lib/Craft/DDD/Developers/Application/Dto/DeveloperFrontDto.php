<?php

namespace Craft\DDD\Developers\Application\Dto;

use Craft\DDD\Developers\Domain\Entity\Developer;

class DeveloperFrontDto
{
	public function __construct(
		public int    $id,
		public string $name,
		public ?array $picture = null
	)
	{
	}

	public static function fromModel(Developer $developer): static
	{
		$file = \CFile::GetFileArray($developer->getPictureId());

		return new static(
			$developer->getId(),
			$developer->getName(),
			$file
		);
	}
}