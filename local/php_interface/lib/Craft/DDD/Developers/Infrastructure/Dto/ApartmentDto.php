<?php

namespace Craft\DDD\Developers\Infrastructure\Dto;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;

class ApartmentDto
{
	public function __construct(
		public ?string         $id,
		public ?string         $name,
		public ?string         $price,
		public ?BuildObjectDto $buildObject,
	)
	{
	}

	public static function fromModel(ApartmentEntity $model): static
	{
		$buildObject = $model->getBuildObject() ? BuildObjectDto::fromModel($model->getBuildObject()) : null;

		return new static(
			$model->getId(),
			$model->getName(),
			$model->getPrice(),
			$buildObject,
		);
	}
}