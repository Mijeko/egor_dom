<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

final class LongitudeValueObject
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