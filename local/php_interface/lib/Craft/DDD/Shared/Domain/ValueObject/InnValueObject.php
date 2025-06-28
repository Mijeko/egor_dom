<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

class InnValueObject
{
	public function __construct(
		protected int $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(int $value): void
	{

		if(!DigitsValidateHelper::validateDigits($value, 12) && !DigitsValidateHelper::validateDigits($value, 10))
		{
			throw new \Exception('ИНН должен содержать 12 или 10 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}