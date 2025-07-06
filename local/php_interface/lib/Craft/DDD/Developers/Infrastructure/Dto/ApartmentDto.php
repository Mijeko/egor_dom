<?php

namespace Craft\DDD\Developers\Infrastructure\Dto;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;

class ApartmentDto
{
	public function __construct(
		public ?string         $id,
		public ?string         $name,
		public ?string         $price,
		public ?int            $rooms,
		public ?int            $floor,
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
			$model->getRooms(),
			$model->getFloor(),
			$buildObject,
		);
	}
}