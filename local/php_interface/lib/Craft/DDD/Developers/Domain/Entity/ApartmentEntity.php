<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\Developers\Domain\ValueObject\AreaValueObject;
use Craft\DDD\Developers\Domain\ValueObject\BuiltStateValueObject;
use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;
use Craft\DDD\Developers\Domain\ValueObject\StringLogicValueObject;
use Craft\DDD\Developers\Infrastructure\Entity\Apartment;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;
use function Symfony\Component\String\b;

class ApartmentEntity
{
	public function __construct(
		protected ?int                     $id,
		protected ?int                     $buildObjectId,
		protected ?BuildObjectEntity       $buildObject,
		protected ?string                  $name,
		protected ?string                  $description,
		protected ?int                     $price,
		protected ?int                     $rooms,
		protected ?int                     $floor,
		protected ?AreaValueObject         $area,
		protected ?string                  $renovation,
		protected ?StringLogicValueObject  $parking,
		protected ?StringLogicValueObject  $bathroomUnit,
		protected ?string                  $mortgage,
		protected ?int                     $builtYear,
		protected ?BuiltStateValueObject   $buildingState,
		protected ?ImageGalleryValueObject $planImages = null,
		protected ?ImageGalleryValueObject $gallery = null,
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
	public static function fromImport(
		?BuildObjectEntity       $buildObject,
		?string                  $description,
		?int                     $price,
		?int                     $rooms,
		?int                     $floor,
		?AreaValueObject         $area,
		?string                  $renovation,
		?StringLogicValueObject  $parking,
		?StringLogicValueObject  $bathroomUnit,
		?int                     $mortgage,
		?int                     $builtYear,
		?BuiltStateValueObject   $buildingState,
		?ImageGalleryValueObject $planImages = null,
		?ImageGalleryValueObject $gallery = null,

	): static
	{
		$entity = new static(
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
			$buildingState,
			$planImages,
			$gallery,
		);

		$entity->generateName();

		return $entity;
	}

	public static function fromModel(Apartment $apartment): static
	{
	}


	public function addBuildObject(BuildObjectEntity $buildObject): static
	{
		$this->buildObject = $buildObject;
		return $this;
	}

	public function generateName(): static
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

	public function refreshId(int $id): static
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
}