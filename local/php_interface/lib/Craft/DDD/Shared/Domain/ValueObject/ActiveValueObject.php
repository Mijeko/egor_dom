<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class ActiveValueObject
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

	public static function fromBx(string $value): static
	{
		return new static($value);
	}

	public function getValue(): bool
	{
		return $this->value;
	}


}