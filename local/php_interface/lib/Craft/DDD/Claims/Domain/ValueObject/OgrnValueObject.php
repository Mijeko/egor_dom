<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

class OgrnValueObject
{

	public function __construct(
		protected int $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(int $value): void
	{

		if(mb_strlen($value) !== 13 || mb_strlen($value) !== 15)
		{
			throw new \Exception('Ogrn value must be 13-15 characters');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}