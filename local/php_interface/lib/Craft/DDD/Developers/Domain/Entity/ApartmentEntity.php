<?php

namespace Craft\DDD\Developers\Domain\Entity;

class ApartmentEntity
{
	public function __construct(
		protected int    $id,
		protected int    $buildObjectId,
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

	public function getBuildObjectId(): int
	{
		return $this->buildObjectId;
	}
}