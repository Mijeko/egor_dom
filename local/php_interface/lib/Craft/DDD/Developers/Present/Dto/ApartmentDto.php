<?php

namespace Craft\DDD\Developers\Present\Dto;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\Dto\BxImageDto;

final class ApartmentDto
{
	public function __construct(
		public ?int            $id,
		public ?int            $buildObjectId,
		public ?string         $name,
		public ?string         $price,
		public ?int            $rooms,
		public ?int            $floor,
		public ?int            $builtYear,
		public ?string         $builtState,
		public ?BuildObjectDto $buildObject,
		public ?array          $planImages,
	)
	{
	}

	public static function fromEntity(ApartmentEntity $model): ApartmentDto
	{
		$buildObject = $model->getBuildObject() ? BuildObjectDto::fromModel($model->getBuildObject()) : null;

		return new ApartmentDto(
			$model->getId(),
			$model->getBuildObjectId(),
			$model->getName(),
			$model->getPrice(),
			$model->getRooms(),
			$model->getFloor(),
			$model->getBuiltYear(),
			$model->getBuildingState()->getLabel(),
			$buildObject,
			null
		);
	}
}