<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\Developers\Domain\ValueObject\AreaValueObject;
use Craft\DDD\Developers\Domain\ValueObject\BuiltStateValueObject;
use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;
use Craft\DDD\Developers\Domain\ValueObject\StringLogicValueObject;


/**
 * @property  BuildObjectEntity $buildObject
 * @property  string $name Название
 * @property  string|null $description Описание
 * @property  int $price Цена
 * @property  int $rooms Комнаты
 * @property  int $floor Этаж
 * @property  AreaValueObject $area Площадь
 * @property  string $renovation Отделка
 * @property  StringLogicValueObject|null $parking Парковка
 * @property  StringLogicValueObject|null $bathroomUnit Сануазел раздельный/совместный
 * @property  int|null $floorsTotal Всего этажей
 * @property  int|null $mortgage Ипотека ?
 * @property  int|null $builtYear Год постройки
 * @property  BuiltStateValueObject|null $buildingState Статус постройки
 * @property  LocationValueObject|null $location Локация
 */
class ApartmentEntity
{
	public function __construct(
		protected ?int                    $id,
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
		protected ?int                    $floorsTotal,
		protected ?int                    $mortgage,
		protected ?int                    $builtYear,
		protected ?BuiltStateValueObject  $buildingState,
		protected ?LocationValueObject    $location,
		protected ?array                  $planImages = null,
		protected ?array                  $gallery = null,
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
		?BuildObjectEntity      $buildObject,
		?string                 $description,
		?int                    $price,
		?int                    $rooms,
		?int                    $floor,
		?AreaValueObject        $area,
		?string                 $renovation,
		?StringLogicValueObject $parking,
		?StringLogicValueObject $bathroomUnit,
		?int                    $floorsTotal,
		?int                    $mortgage,
		?int                    $builtYear,
		?BuiltStateValueObject  $buildingState,
		?LocationValueObject    $location,
		?array                  $planImages = null,
		?array                  $gallery = null,

	): static
	{
		$entity = new static(
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
			$floorsTotal,
			$mortgage,
			$builtYear,
			$buildingState,
			$location,
			$planImages,
			$gallery,
		);

		$entity->generateName();

		return $entity;
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


		if($apart = $this->location->getApartment()->getValue())
		{
			$resultName .= ' ' . $apart;
		}

		$this->name = $resultName;

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

	public function getBuildObject(): BuildObjectEntity
	{
		return $this->buildObject;
	}
}