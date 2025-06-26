<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

class BikValueObject
{
	public function __construct(
		protected int $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(int $value): void
	{

		if(mb_strlen($value) !== 9)
		{
			throw new \Exception('Bik value must be 9');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}