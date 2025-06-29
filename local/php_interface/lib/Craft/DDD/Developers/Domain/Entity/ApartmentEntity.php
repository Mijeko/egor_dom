<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\Developers\Domain\ValueObject\AreaValueObject;


/**
 * @property int $floor Этаж
 * @property string $renovation Отделка
 */
class ApartmentEntity
{
	public function __construct(
		protected ?int              $id,
		protected BuildObjectEntity $buildObject,
		protected string            $name,
		protected int               $price,
		protected int               $rooms,
		protected int               $floor,
		protected AreaValueObject   $area,
		protected string            $renovation,
	)
	{
	}

	public static function fromImport(
		BuildObjectEntity $buildObject,
		string            $name,
		int               $price,
		int               $rooms,
		int               $floor,
		AreaValueObject   $area,
		string            $renovation,
	): static
	{
		return new static(
			null,
			$buildObject,
			$name,
			$price,
			$rooms,
			$floor,
			$area,
			$renovation,
		);
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