<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class SortValueObject
{
	public function __construct(
		protected int $value
	)
	{
	}

	public function getValue(): int
	{
		return $this->value;
	}

	public static function default(): static
	{
		return new static(500);
	}
}