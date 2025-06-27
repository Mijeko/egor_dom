<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

class KppValueObject
{
	public function __construct(
		protected int $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(int $value): void
	{

		if(!DigitsValidateHelper::validateDigits($value, 9))
		{
			throw new \Exception('КПП должно содержать 9 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}