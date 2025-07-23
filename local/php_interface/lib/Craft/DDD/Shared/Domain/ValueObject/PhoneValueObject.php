<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

class PhoneValueObject
{
	public function __construct(
		protected string $value
	)
	{
	}

	protected function validate($value): void
	{
		if(mb_strlen($value) === 0)
		{
			throw new \Exception('Номер телефона должен быть заполнен');
		}

		if(!DigitsValidateHelper::validateDigits($value, 11))
		{
			throw new \Exception('Номер телефона должен содержать 11 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): string
	{
		return $this->normalize($this->value);
	}

	private function normalize(string $value): string
	{
		if(str_starts_with($value, '+7'))
		{
			return $value;
		}

		if(str_starts_with($value, '8'))
		{
			return '+7' . substr($value, 1, strlen($value) - 1);
		}

		return $value;
	}
}