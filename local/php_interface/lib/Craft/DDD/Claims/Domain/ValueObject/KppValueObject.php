<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

class KppValueObject
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
			throw new \Exception('Kpp value must be 9 digits');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}