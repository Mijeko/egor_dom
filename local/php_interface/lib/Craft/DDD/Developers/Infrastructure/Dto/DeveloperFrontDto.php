<?php

namespace Craft\DDD\Developers\Infrastructure\Dto;

use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\Dto\BxImageDto;

class DeveloperFrontDto
{
	public function __construct(
		public int      $id,
		public string   $name,
		public ?BxImageDto $picture = null
	)
	{
	}

	public static function fromModel(DeveloperEntity $developer): static
	{
		return new static(
			$developer->getId(),
			$developer->getName(),
			$developer->getPicture(),
		);
	}
}