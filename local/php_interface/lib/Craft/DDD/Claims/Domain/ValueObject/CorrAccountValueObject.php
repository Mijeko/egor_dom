<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

class CorrAccountValueObject
{
	public function __construct(
		protected int $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(int $value): void
	{

		if(mb_strlen($value) !== 20)
		{
			throw new \Exception('Corr account value must be 20');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}