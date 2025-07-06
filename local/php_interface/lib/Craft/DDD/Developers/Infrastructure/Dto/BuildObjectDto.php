<?php

namespace Craft\DDD\Developers\Infrastructure\Dto;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Infrastructure\LocationDto;
use Craft\Dto\BxImageDto;


/**
 * @var BxImageDto[] $gallery
 */
class BuildObjectDto
{
	public function __construct(
		public int                $id,
		public ?string            $name,
		public ?string            $type,
		public ?int               $floors,
		public ?DeveloperFrontDto $developer,
		public ?array             $gallery = null,
		public ?array             $apartments = null,
		public ?LocationDto       $location = null,
		public ?string            $detailLink = null,
	)
	{
	}


	public static function fromModel(BuildObjectEntity $element): static
	{
		$location = $element->getLocation() ? LocationDto::fromModel($element->getLocation()) : null;
		$developer = $element->getDeveloper() ? DeveloperFrontDto::fromModel($element->getDeveloper()) : null;

		$gallery = [];
		if($element->getGallery())
		{
			$gallery = array_map(function(ImageValueObject $image) {
				return new BxImageDto(
					$image->getId(),
					$image->getSrc()
				);
			}, $element->getGallery()->getImages());
		}

		return new static(
			$element->getId(),
			$element->getName(),
			$element->getType(),
			$element->getFloors(),
			$developer,
			$gallery,
			array_values(array_map(
				function(ApartmentEntity $item) {
					return ApartmentDto::fromModel($item);
				},
				$element->getApartments() ?? []
			)),
			$location,
			'/objects/' . $element->getId() . '/'
		);
	}
}