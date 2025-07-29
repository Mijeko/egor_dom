<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

final class OgrnValueObject
{

	public function __construct(
		protected string $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(string $value): void
	{

		if(!DigitsValidateHelper::validateDigits($value, 13) && !DigitsValidateHelper::validateDigits($value, 15))
		{
			throw new \Exception('ОГРН/ОГРНИП должен содержать 13 или 15 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): string
	{
		return $this->value;
	}
}