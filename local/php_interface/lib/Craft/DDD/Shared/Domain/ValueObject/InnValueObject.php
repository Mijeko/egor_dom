<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

final class InnValueObject
{
	public function __construct(
		protected string $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(string $value): void
	{

		if(!DigitsValidateHelper::validateDigits($value, 12) && !DigitsValidateHelper::validateDigits($value, 10))
		{
			throw new \Exception('ИНН должен содержать 12 или 10 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): string
	{
		return $this->value;
	}
}