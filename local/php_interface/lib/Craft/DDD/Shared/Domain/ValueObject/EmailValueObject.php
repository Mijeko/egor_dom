<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class EmailValueObject
{
	public function __construct(
		protected string $value
	)
	{
	}

	protected function validate(string $value): void
	{
		$this->value = $value;
	}

	public function getValue(): string
	{
		return $this->value;
	}
}