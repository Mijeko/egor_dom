<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class DateTimeValueObject
{
	public function __construct(
		public \DateTime $value
	)
	{
	}

	public function format(string $format): string
	{
		return $this->value->format($format);
	}

	public static function now(): DateTimeValueObject
	{
		return new static(new \DateTime());
	}

	public static function fromTimestamp(int $timestamp): DateTimeValueObject
	{
		return new static(new \DateTime('@' . $timestamp));
	}
}