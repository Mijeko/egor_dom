<?php

namespace Craft\DDD\FavoriteProduct\Domain\ValueObject;

class UserIdValueObject
{

	public function __construct(
		private int $value
	)
	{
		$this->validate();
	}

	private function validate(): void
	{
		if($this->value < 0)
		{
			throw new \Exception("Product ID должен быть больше 0");
		}
	}


	public function getValue(): int
	{
		return $this->value;
	}
}