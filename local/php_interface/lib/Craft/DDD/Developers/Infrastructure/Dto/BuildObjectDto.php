<?php

namespace Craft\DDD\Developers\Infrastructure\Dto;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\Dto\BxImageDto;


/**
 * @var BxImageDto[] $gallery
 */
class BuildObjectDto
{
	public function __construct(
		public int                $id,
		public ?string            $name,
		public ?int               $floors,
		public ?DeveloperFrontDto $developer,
		public ?array             $gallery = null,
		public ?array             $apartments = null,
	)
	{
	}


	public static function fromModel(BuildObjectEntity $element): static
	{
		return new static(
			$element->getId(),
			$element->getName(),
			$element->getFloors(),
			DeveloperFrontDto::fromModel($element->getDeveloper()),
			array_map(function(ImageValueObject $image) {
				return new BxImageDto(
					$image->getId(),
					$image->getSrc()
				);
			}, $element->getGallery()->getImages()),
			array_map(
				function(ApartmentEntity $item) {
					return ApartmentDto::fromModel($item);
				},
				$element->getApartments() ?? []
			),
		);
	}
}