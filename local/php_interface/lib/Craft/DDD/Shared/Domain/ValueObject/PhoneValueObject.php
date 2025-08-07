<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

final class PhoneValueObject
{
	public function __construct(
		protected ?string $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(?string $value): void
	{
		if(is_null($value))
		{
			return;
		}

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

	public function getValue(): ?string
	{
		if(is_null($this->value))
		{
			return null;
		}

		return $this->normalize($this->value);
	}

	private function normalize(string $value): string
	{
		$value = str_replace([' ', '-', '(', ')'], '', $value);
		
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