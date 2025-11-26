<?php

namespace Craft\DDD\Developers\Present\Dto;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\Dto\BxImageDto;

final class DeveloperDto
{

	public ?BxImageDto $picture = null;
	public ?array $buildObjects = [];


	public function __construct(
		public int     $id,
		public int     $cityId,
		public string  $name,
		public ?string $description,
	)
	{
	}

	public static function fromModel(DeveloperEntity $developer): DeveloperDto
	{
		return new DeveloperDto(
			$developer->getId(),
			$developer->getCityId(),
			$developer->getName(),
			$developer->getDescription()->getValue(),
		);
	}
}