<?php

namespace Craft\DDD\Developers\Infrastructure\Dto;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\Dto\BxImageDto;

class DeveloperFrontDto
{
	public function __construct(
		public int         $id,
		public string      $name,
		public ?BxImageDto $picture = null,
		public ?array      $buildObjects = [],
	)
	{
	}

	public static function fromModel(DeveloperEntity $developer): static
	{
		return new static(
			$developer->getId(),
			$developer->getName(),
			$developer->getPicture(),
			array_map(function(BuildObjectEntity $buildObject) {
				return new BuildObjectFrontDto(
					$buildObject->getId(),
					$buildObject->getName(),
				);
			}, $developer->getBuildObjects() ?? []),
		);
	}
}