<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

class CorrAccountValueObject
{
	public function __construct(
		protected int $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(int $value): void
	{

		if(!DigitsValidateHelper::validateDigits($value, 20))
		{
			throw new \Exception('Корреспондентский счет должен содержать 20 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}