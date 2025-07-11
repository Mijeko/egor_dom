<?php

namespace Craft\DDD\Developers\Present\Dto;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\Dto\BxImageDto;

class ApartmentDto
{
	public function __construct(
		public ?string         $id,
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

	public static function fromEntity(ApartmentEntity $model): static
	{
		$buildObject = $model->getBuildObject() ? BuildObjectDto::fromModel($model->getBuildObject()) : null;

		return new static(
			$model->getId(),
			$model->getName(),
			$model->getPrice(),
			$model->getRooms(),
			$model->getFloor(),
			$model->getBuiltYear(),
			$model->getBuildingState()->getLabel(),
			$buildObject,
			array_map(function(ImageValueObject $imageGallery) {
				return new BxImageDto(
					$imageGallery->getId(),
					$imageGallery->getSrc(),
				);
			}, $model->getPlanImages()->getImages())
		);
	}
}