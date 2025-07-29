<?php

namespace Craft\DDD\Developers\Present\Dto;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\Dto\BxImageDto;

final class DeveloperDto
{
	public function __construct(
		public int         $id,
		public string      $name,
		public ?BxImageDto $picture = null,
		public ?array      $buildObjects = [],
	)
	{
	}

	public static function fromModel(DeveloperEntity $developer): DeveloperDto
	{
		$pictureDto = null;
		if($picture = $developer->getPicture())
		{
			$pictureDto = new BxImageDto(
				$picture->getId(),
				$picture->getSrc()
			);
		}

		return new DeveloperDto(
			$developer->getId(),
			$developer->getName(),
			$pictureDto,
			array_map(
				function(BuildObjectEntity $buildObject) {
					return BuildObjectDto::fromModel($buildObject);
				},
				$developer->getBuildObjects() ?? []
			),
		);
	}
}