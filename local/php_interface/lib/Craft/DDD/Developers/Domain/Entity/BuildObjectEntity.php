<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;

class BuildObjectEntity
{
	public function __construct(
		protected ?int                     $id,
		protected ?string                  $name,
		protected ?string                  $type,
		protected ?int                     $floors,
		protected ?LocationValueObject     $location,
		protected ?int                     $developerId = null,
		protected ?DeveloperEntity         $developer = null,
		protected ?array                   $apartments = null,
		protected ?ImageGalleryValueObject $gallery = null,
		protected ?CityEntity              $city = null,
	)
	{
	}


	public static function fromImport(
		?string                  $name,
		?string                  $type,
		?int                     $floors,
		?LocationValueObject     $location,
		DeveloperEntity          $developer,
		?ImageGalleryValueObject $gallery,
		?CityEntity              $city,
	): static
	{
		return new static(
			null,
			$name,
			$type,
			$floors,
			$location,
			$developer->getId(),
			$developer,
			null,
			$gallery,
			$city,
		);
	}

	public function refreshId(int $id): static
	{
		$this->id = $id;
		return $this;
	}

	public function addDeveloper(DeveloperEntity $developer): static
	{
		$this->developer = $developer;
		return $this;
	}

	public function addApartment(ApartmentEntity $apartmentEntity): static
	{
		$this->apartments[$apartmentEntity->getId()] = $apartmentEntity;
		return $this;
	}

	public function addApartments(array $apartments): static
	{
		$this->apartments = $apartments;
		return $this;
	}

	public function getDeveloper(): ?DeveloperEntity
	{
		return $this->developer;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getId(): int
	{
		return $this->id;
	}


	public function getDeveloperId(): ?int
	{
		return $this->developerId;
	}

	/**
	 * @return \Craft\DDD\Developers\Domain\Entity\ApartmentEntity[] | null
	 */
	public function getApartments(): ?array
	{
		return $this->apartments;
	}

	public function getGallery(): ?ImageGalleryValueObject
	{
		return $this->gallery;
	}

	public function getLocation(): ?LocationValueObject
	{
		return $this->location;
	}


	public function getFloors(): ?int
	{
		return $this->floors;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function getCity(): ?CityEntity
	{
		return $this->city;
	}
}