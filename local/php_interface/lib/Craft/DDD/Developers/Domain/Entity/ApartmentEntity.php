<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\Developers\Domain\ValueObject\AreaValueObject;
use Craft\DDD\Developers\Domain\ValueObject\BuiltStateValueObject;
use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;
use Craft\DDD\Developers\Domain\ValueObject\StringLogicValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;

final class ApartmentEntity
{
	protected ?ImageGalleryValueObject $planImages = null;
	protected ?ImageGalleryValueObject $gallery = null;

	public function __construct(
		protected ?int                    $id,
		protected ?int                    $buildObjectId,
		protected ?BuildObjectEntity      $buildObject,
		protected ?string                 $name,
		protected ?string                 $description,
		protected ?int                    $price,
		protected ?int                    $rooms,
		protected ?int                    $floor,
		protected ?AreaValueObject        $area,
		protected ?string                 $renovation,
		protected ?StringLogicValueObject $parking,
		protected ?StringLogicValueObject $bathroomUnit,
		protected ?string                 $mortgage,
		protected ?int                    $builtYear,
		protected ?array                  $planImagesIdList,
		protected ?array                  $galleryIdList,
		protected ?BuiltStateValueObject  $buildingState,
		protected ?string                 $externalId = null,
	)
	{
	}


	/**
	 *
	 * Название квартиры формируется автоматически
	 *
	 * @param BuildObjectEntity $buildObject
	 * @param string|null $description Описание
	 * @param int $price Цена
	 * @param int $rooms Комнаты
	 * @param int $floor Этаж
	 * @param AreaValueObject $area
	 * @param string $renovation Отделка
	 * @param StringLogicValueObject|null $parking Парковка
	 * @param StringLogicValueObject|null $bathroomUnit Сануазел раздельный/совместный
	 * @param int|null $floorsTotal Всего этажей
	 * @param int|null $mortgage Ипотека ?
	 * @param int|null $builtYear Год постройки
	 * @param BuiltStateValueObject|null $buildingState Статус постройки
	 * @param LocationValueObject|null $location Локация
	 * @return ApartmentEntity
	 */
	public static function createFromImport(
		?BuildObjectEntity      $buildObject,
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
		?array                  $galleryIdList,
		?BuiltStateValueObject  $buildingState,
		string                  $externalId,

	): ApartmentEntity
	{
		$entity = new ApartmentEntity(
			null,
			null,
			$buildObject,
			null,
			$description,
			$price,
			$rooms,
			$floor,
			$area,
			$renovation,
			$parking,
			$bathroomUnit,
			$mortgage,
			$builtYear,
			$planImagesIdList,
			$galleryIdList,
			$buildingState,
			$externalId,
		);

		$entity->generateName();

		return $entity;
	}

	public function updateFromImport(
		?BuildObjectEntity      $buildObject,
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
		?array                  $galleryIdList,
	): ApartmentEntity
	{

		$this->buildObject = $buildObject;
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
		$this->galleryIdList = $galleryIdList;
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