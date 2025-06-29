<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class PasswordValueObject
{
	public function __construct(
		protected string $value
	)
	{
		$this->validate($value);
	}


	protected function validate(string $value): void
	{

		if(mb_strlen($value) <= 0)
		{
			throw new \Exception('Password must have at least one letter');
		}

		$this->value = $value;
	}

	public function getValue(): string
	{
		return $this->value;
	}
}