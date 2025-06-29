<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class KitchenSpaceValueObject
{
	public function __construct(
		protected string $value,
		protected string $unit,
	)
	{
	}

	public function getUnit(): string
	{
		return $this->unit;
	}

	public function getValue(): string
	{
		return $this->value;
	}
}