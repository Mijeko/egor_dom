<?php

namespace Craft\DDD\Developers\Present\Dto;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\Dto\BxImageDto;

class DeveloperDto
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
			new BxImageDto(
				$developer->getPicture()->getId(),
				$developer->getPicture()->getSrc()
			),
			array_map(
				function(BuildObjectEntity $buildObject) {
					return BuildObjectDto::fromModel($buildObject);
				},
				$developer->getBuildObjects() ?? []
			),
		);
	}
}