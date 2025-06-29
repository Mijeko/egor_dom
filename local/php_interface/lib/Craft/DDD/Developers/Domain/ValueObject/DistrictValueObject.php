<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class DistrictValueObject
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