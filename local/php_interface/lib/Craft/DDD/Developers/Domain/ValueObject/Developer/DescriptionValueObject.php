<?php

namespace Craft\DDD\Developers\Domain\ValueObject\Developer;

class DescriptionValueObject
{
	public function __construct(
		private ?string $value,
	)
	{
	}

	protected function validate(): void
	{
		if(mb_strlen($this->value) > 255)
		{
			throw new \Exception("Описание не может содержать больше 255 символа.");
		}
	}

	public function getValue(): ?string
	{
		return $this->value;
	}

	public static function empty(): DescriptionValueObject
	{
		return new self(null);
	}
}