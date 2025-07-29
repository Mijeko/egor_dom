<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Craft\Helper\DigitsValidateHelper;

final class KppValueObject
{
	public function __construct(
		protected string $value
	)
	{
		$this->validate($this->value);
	}

	protected function validate(string $value): void
	{

		if(!DigitsValidateHelper::validateDigits($value, 9))
		{
			throw new \Exception('КПП должно содержать 9 цифр');
		}

		$this->value = $value;
	}

	public function getValue(): string
	{
		return $this->value;
	}
}