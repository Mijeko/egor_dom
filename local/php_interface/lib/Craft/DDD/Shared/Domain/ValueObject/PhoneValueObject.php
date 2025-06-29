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
		return $this->value;
	}
}