<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class CityValueObject
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