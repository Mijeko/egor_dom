<?php

namespace Craft\DDD\Developers\Infrastructure\Dto;

use Craft\DDD\Developers\Domain\Entity\Developer;
use Craft\Dto\BxImage;

class DeveloperFrontDto
{
	public function __construct(
		public int      $id,
		public string   $name,
		public ?BxImage $picture = null
	)
	{
	}

	public static function fromModel(Developer $developer): static
	{
		return new static(
			$developer->getId(),
			$developer->getName(),
			$developer->getPicture(),
		);
	}
}