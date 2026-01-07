<?php

namespace Craft\DDD\UserBehavior\Domain\ValueObject;

use Craft\DDD\Shared\Domain\Exceptions\FailedValueObjectValidateValueException;

class DetailLinkValueObject
{

	public function __construct(
		private string $value
	)
	{
		$this->validate();
	}

	protected function validate(): void
	{
		if(mb_strlen($this->value) <= 0)
		{
			throw new FailedValueObjectValidateValueException('');
		}

		if(mb_strlen($this->value) > 255)
		{
			throw new FailedValueObjectValidateValueException('');
		}
	}

	public function getValue(): string
	{
		return $this->value;
	}

}