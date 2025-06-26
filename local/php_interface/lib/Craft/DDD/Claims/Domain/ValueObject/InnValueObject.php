<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

class InnValueObject
{
	public function __construct(
		protected int $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(int $value): void
	{

		if(mb_strlen($value) !== 12 || mb_strlen($value) !== 10)
		{
			throw new \Exception('Inn value must be 12 characters or 10 characters long');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}