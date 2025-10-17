<?php

namespace Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject;

class MaxReservHourValueObject
{
	public function __construct(
		private ?int $value = null,
	)
	{
	}

	public function getValue(): ?int
	{
		return $this->value;
	}
}