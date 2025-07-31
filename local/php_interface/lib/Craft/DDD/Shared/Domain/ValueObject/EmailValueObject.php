<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

final class EmailValueObject
{
	public function __construct(
		protected ?string $value
	)
	{
	}

	protected function validate(?string $value): void
	{
		if(is_null($value))
		{
			return;
		}

		if(mb_strlen($value) <= 0)
		{
			throw new \Exception('E-mail обязателен');
		}

		if(filter_var($value, FILTER_VALIDATE_EMAIL) === false)
		{
			throw new \Exception('E-mail адрес не корректный');
		}


		$this->value = $value;
	}

	public function getValue(): ?string
	{
		return $this->value;
	}
}