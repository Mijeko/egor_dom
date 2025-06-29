<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class LatitudeValueObject
{
	public function __construct(
		protected ?float $value,
	)
	{
	}

	public function getValue(): ?float
	{
		return $this->value;
	}
}