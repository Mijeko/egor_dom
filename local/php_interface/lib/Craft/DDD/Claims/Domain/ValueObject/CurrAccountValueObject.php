<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

use Bitrix\Main\Diag\Debug;
use Craft\Helper\DigitsValidateHelper;

class CurrAccountValueObject
{
	public function __construct(
		protected string $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(string $value): void
	{
		if(!DigitsValidateHelper::validateDigits($value, 20))
		{
			throw new \Exception('Расчетный счет должен содержать 20 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): string
	{
		return $this->value;
	}
}