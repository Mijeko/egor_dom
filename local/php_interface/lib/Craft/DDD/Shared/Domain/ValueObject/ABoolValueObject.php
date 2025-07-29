<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

abstract class ABoolValueObject
{
	public function __construct(
		protected bool|string $value
	)
	{

		$this->validate($this->value);
	}

	protected function validate(string|bool $value): void
	{
		if(!is_bool($value) && !in_array($value, ['Y', 'N']))
		{
			throw new \Exception('Неверное значение активности');
		}
	}

	public function getValue(): bool
	{
		return $this->value;
	}
}