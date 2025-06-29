<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class AddressValueObject
{
	public function __construct(
		protected string $value,
	)
	{
	}

	public function getValue(): string
	{
		return $this->value;
	}
}