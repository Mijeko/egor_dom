<?php

namespace Craft\DDD\Apartment\Domain\Entity;

class ApartmentEntity
{
	public function __construct(
		protected int    $id,
		protected string $name,
		protected int    $price,
	)
	{
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
}