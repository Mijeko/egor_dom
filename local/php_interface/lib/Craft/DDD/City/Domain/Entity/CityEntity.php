<?php

namespace Craft\DDD\City\Domain\Entity;

use Craft\DDD\City\Infrastructure\Entity\City;
use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;
use Craft\DDD\Shared\Domain\ValueObject\SortValueObject;

class CityEntity
{
	public function __construct(
		protected ?int               $id,
		protected ?string            $name,
		protected ?string            $code,
		protected ?ActiveValueObject $active,
		protected ?SortValueObject   $sort,
	)
	{
	}

	public static function fromModel(City $city): static
	{
		return new static(
			$city->getId(),
			$city->getName(),
			$city->getCode(),
			new ActiveValueObject($city->getActive()),
			new SortValueObject($city->getSort()),
		);
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getCode(): ?string
	{
		return $this->code;
	}

	public function getActive(): ?ActiveValueObject
	{
		return $this->active;
	}

	public function getSort(): ?SortValueObject
	{
		return $this->sort;
	}
}