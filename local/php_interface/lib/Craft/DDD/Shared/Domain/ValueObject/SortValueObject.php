<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

final class SortValueObject
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

	public static function default(): SortValueObject
	{
		return new SortValueObject(500);
	}
}