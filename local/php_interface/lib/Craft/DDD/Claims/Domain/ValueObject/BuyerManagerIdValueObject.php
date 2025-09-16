<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

class BuyerManagerIdValueObject
{
	public function __construct(
		private ?int $value,
	)
	{
		$this->validate();
	}

	private function validate(): void
	{
		if(is_null($this->value))
		{
			return;
		}

		if($this->value <= 0)
		{
			throw new \Exception("Значение BuyerManagerId должно быть больше 0");
		}
	}

	public function getValue(): ?int
	{
		return $this->value;
	}
}