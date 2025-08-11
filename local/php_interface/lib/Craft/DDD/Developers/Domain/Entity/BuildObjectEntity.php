<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;

class BuildObjectEntity
{
	protected ?int $id;
	protected ?string $name;
	protected ?string $type;
	protected ?int $floors;
	protected ?LocationValueObject $location;
	protected ?array $galleryIdList = null;
	protected ?int $developerId = null;
	protected ?DeveloperEntity $developer = null;
	protected ?array $apartments = null;
	protected ?CityEntity $city = null;

	protected ?ImageGalleryValueObject $gallery = null;

	public static function hydrate(
		?int                 $id,
		?string              $name,
		?string              $type,
		?int                 $floors,
		?LocationValueObject $location,
		?array               $galleryIdList = null,
		?int                 $developerId = null,
	): BuildObjectEntity
	{
		$self = new self();
		$self->id = $id;
		$self->name = $name;
		$self->type = $type;
		$self->floors = $floors;
		$self->location = $location;
		$self->galleryIdList = $galleryIdList;
		$self->developerId = $developerId;
		return $self;
	}


	public static function createFromImport(
		?string              $name,
		?string              $type,
		?int                 $floors,
		?LocationValueObject $location,
		DeveloperEntity      $developer,
		?array               $galleryIdList,
		CityEntity           $city,
	): BuildObjectEntity
	{
		$self = new self();
		$self->name = $name;
		$self->type = $type;
		$self->floors = $floors;
		$self->location = $location;
		$self->developer = $developer;
		$self->galleryIdList = $galleryIdList;
		$self->city = $city;
		return $self;
	}

	public function updateFromImport(
		?string              $name,
		?string              $type,
		?int                 $floors,
		?LocationValueObject $location,
		DeveloperEntity      $developer,
		?array               $galleryIdList,
		CityEntity           $city,
	): BuildObjectEntity
	{
		$this->name = $name;
		$this->type = $type;
		$this->floors = $floors;
		$this->location = $location;
		$this->developer = $developer;
		$this->galleryIdList = $galleryIdList;
		$this->city = $city;
		return $this;
	}

	public function refreshId(int $id): BuildObjectEntity
	{
		$this->id = $id;
		return $this;
	}

	public function addGalleryImage(ImageGalleryValueObject $galleryValueObject): BuildObjectEntity
	{
		$this->gallery = $galleryValueObject;
		return $this;
	}

	public function addDeveloper(DeveloperEntity $developer): BuildObjectEntity
	{
		$this->developer = $developer;
		return $this;
	}

	public function addApartment(ApartmentEntity $apartmentEntity): BuildObjectEntity
	{
		$this->apartments[$apartmentEntity->getId()] = $apartmentEntity;
		return $this;
	}

	public function addApartments(array $apartments): BuildObjectEntity
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

	public function getGalleryIdList(): ?array
	{
		return $this->galleryIdList;
	}
}