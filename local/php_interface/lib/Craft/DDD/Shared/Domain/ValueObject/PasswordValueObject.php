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
			throw new \Exception('Пароль должен быть заполнен');
		}

		$this->value = $value;
	}

	public function getValue(): string
	{
		return $this->value;
	}
}