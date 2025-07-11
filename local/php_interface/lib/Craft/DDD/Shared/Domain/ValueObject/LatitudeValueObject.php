<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class LatitudeValueObject
{
	public function __construct(
		protected ?string $value,
	)
	{
	}

	public function getValue(): ?string
	{
		return $this->value;
	}
}