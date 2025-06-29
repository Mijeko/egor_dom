<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class LivingSpaceValueObject
{
	public function __construct(
		protected float  $value,
		protected string $unit,
	)
	{
	}

	public function getValue(): float
	{
		return $this->value;
	}

	public function getUnit(): string
	{
		return $this->unit;
	}
}