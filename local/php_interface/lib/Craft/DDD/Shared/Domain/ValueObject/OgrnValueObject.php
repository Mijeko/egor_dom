<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

class OgrnValueObject
{

	public function __construct(
		protected int $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(int $value): void
	{

		if(!DigitsValidateHelper::validateDigits($value, 13) && !DigitsValidateHelper::validateDigits($value, 15))
		{
			throw new \Exception('ОГРН/ОГРНИП должен содержать 13 или 15 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): int
	{
		return $this->value;
	}
}