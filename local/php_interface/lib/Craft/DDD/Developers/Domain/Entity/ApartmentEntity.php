<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\Developers\Domain\ValueObject\AreaValueObject;
use Craft\DDD\Developers\Domain\ValueObject\BuiltStateValueObject;
use Craft\DDD\Developers\Domain\ValueObject\StringLogicValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;

final class ApartmentEntity
{
	protected ?int $id;
	protected ?int $buildObjectId;
	protected ?BuildObjectEntity $buildObject;
	protected ?string $name;
	protected ?string $description;
	protected ?int $price;
	protected ?int $rooms;
	protected ?int $floor;
	protected ?AreaValueObject $area;
	protected ?string $renovation;
	protected ?StringLogicValueObject $parking;
	protected ?StringLogicValueObject $bathroomUnit;
	protected ?string $mortgage;
	protected ?int $builtYear;
	protected ?array $planImagesIdList;
	protected ?array $galleryIdList;
	protected ?BuiltStateValueObject $buildingState;
	protected ?string $externalId = null;


	protected ?ImageGalleryValueObject $planImages = null;
	protected ?ImageGalleryValueObject $gallery = null;

	public static function hydrate(
		int                     $id,
		int                     $buildObjectId,
		string                  $name,
		string                  $description,
		?int                    $price,
		?int                    $rooms,
		?int                    $floor,
		?AreaValueObject        $area,
		?string                 $renovation,
		?StringLogicValueObject $parking,
		?StringLogicValueObject $bathroomUnit,
		?string                 $mortgage,
		?int                    $builtYear,
		?array                  $planImagesIdList,
		?BuiltStateValueObject  $buildingState,
		?string                 $externalId = null,
	): ApartmentEntity
	{
		$self = new self();
		$self->id = $id;
		$self->buildObjectId = $buildObjectId;
		$self->name = $name;
		$self->description = $description;
		$self->price = $price;
		$self->rooms = $rooms;
		$self->floor = $floor;
		$self->area = $area;
		$self->renovation = $renovation;
		$self->parking = $parking;
		$self->bathroomUnit = $bathroomUnit;
		$self->mortgage = $mortgage;
		$self->builtYear = $builtYear;
		$self->planImagesIdList = $planImagesIdList;
		$self->buildingState = $buildingState;
		$self->externalId = $externalId;
		return $self;
	}

	public static function createFromImport(
		?BuildObjectEntity      $buildObject,
		?int                    $buildObjectId,
		?string                 $description,
		?int                    $price,
		?int                    $rooms,
		?int                    $floor,
		?AreaValueObject        $area,
		?string                 $renovation,
		?StringLogicValueObject $parking,
		?StringLogicValueObject $bathroomUnit,
		?int                    $mortgage,
		?int                    $builtYear,
		?array                  $planImagesIdList,
		?BuiltStateValueObject  $buildingState,
		string                  $externalId,

	): ApartmentEntity
	{
		$self = new self();

		$self->buildObject = $buildObject;
		$self->buildObjectId = $buildObjectId;
		$self->description = $description;
		$self->price = $price;
		$self->rooms = $rooms;
		$self->floor = $floor;
		$self->area = $area;
		$self->renovation = $renovation;
		$self->parking = $parking;
		$self->bathroomUnit = $bathroomUnit;
		$self->mortgage = $mortgage;
		$self->builtYear = $builtYear;
		$self->planImagesIdList = $planImagesIdList;
		$self->buildingState = $buildingState;
		$self->externalId = $externalId;
		$self->generateName();

		return $self;
	}

	public function updateFromImport(
		int                     $buildObjectId,
		?string                 $description,
		?int                    $price,
		?int                    $rooms,
		?int                    $floor,
		?AreaValueObject        $area,
		?string                 $renovation,
		?StringLogicValueObject $parking,
		?StringLogicValueObject $bathroomUnit,
		?int                    $mortgage,
		?int                    $builtYear,
		?BuiltStateValueObject  $buildingState,
		?array                  $planImagesIdList,
	): ApartmentEntity
	{

		$this->buildObjectId = $buildObjectId;
		$this->description = $description;
		$this->price = $price;
		$this->rooms = $rooms;
		$this->floor = $floor;
		$this->area = $area;
		$this->renovation = $renovation;
		$this->parking = $parking;
		$this->bathroomUnit = $bathroomUnit;
		$this->mortgage = $mortgage;
		$this->builtYear = $builtYear;
		$this->buildingState = $buildingState;
		$this->planImagesIdList = $planImagesIdList;
		return $this;
	}

	public function addGalleryImage(ImageGalleryValueObject $gallery): ApartmentEntity
	{
		$this->gallery = $gallery;
		return $this;
	}

	public function addPlanImage(ImageGalleryValueObject $planImage): ApartmentEntity
	{
		$this->planImages = $planImage;
		return $this;
	}

	public function addBuildObject(BuildObjectEntity $buildObject): ApartmentEntity
	{
		$this->buildObject = $buildObject;
		return $this;
	}

	public function generateName(): ApartmentEntity
	{
		$resultName = '';

		if($this->rooms)
		{
			$resultName .= $this->rooms . '-комнатная квартира';
		} else
		{
			$resultName .= 'Квартира';
		}

		if($buildObject = $this->getBuildObject())
		{
			$resultName .= ' в ' . $buildObject->getName();
		}


		$this->name = $resultName;

		return $this;
	}

	public function refreshId(int $id): ApartmentEntity
	{
		$this->id = $id;
		return $this;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getPrice(): int
	{
		return $this->price;
	}

	public function getBuildObject(): ?BuildObjectEntity
	{
		return $this->buildObject;
	}

	public function getBuildObjectId(): ?int
	{
		return $this->buildObjectId;
	}

	public function getRooms(): ?int
	{
		return $this->rooms;
	}

	public function getFloor(): ?int
	{
		return $this->floor;
	}

	public function getParking(): ?StringLogicValueObject
	{
		return $this->parking;
	}

	/**
	 * @return AreaValueObject|null
	 */
	public function getArea(): ?AreaValueObject
	{
		return $this->area;
	}

	/**
	 * @return StringLogicValueObject|null
	 */
	public function getBathroomUnit(): ?StringLogicValueObject
	{
		return $this->bathroomUnit;
	}

	/**
	 * @return BuiltStateValueObject|null
	 */
	public function getBuildingState(): ?BuiltStateValueObject
	{
		return $this->buildingState;
	}

	/**
	 * @return int|null
	 */
	public function getBuiltYear(): ?int
	{
		return $this->builtYear;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function getGallery(): ?ImageGalleryValueObject
	{
		return $this->gallery;
	}

	public function getMortgage(): ?string
	{
		return $this->mortgage;
	}

	public function getPlanImages(): ?ImageGalleryValueObject
	{
		return $this->planImages;
	}

	public function getRenovation(): ?string
	{
		return $this->renovation;
	}

	public function setBuildObject(?BuildObjectEntity $buildObject): void
	{
		$this->buildObject = $buildObject;
	}

	public function getExternalId(): ?string
	{
		return $this->externalId;
	}

	public function getPlanImagesIdList(): ?array
	{
		return $this->planImagesIdList;
	}

	public function getGalleryIdList(): ?array
	{
		return $this->galleryIdList;
	}

}