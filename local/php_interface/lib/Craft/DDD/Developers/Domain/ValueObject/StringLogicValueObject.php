<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class StringLogicValueObject
{
	public function __construct(
		protected ?string $value
	)
	{
	}


	public function getValue(): ?string
	{
		return $this->value;
	}

	public function getBoolValue(): bool
	{
		if(is_null($this->value))
		{
			return false;
		}

		return in_array(mb_strtolower($this->value), ['да']);
	}
}