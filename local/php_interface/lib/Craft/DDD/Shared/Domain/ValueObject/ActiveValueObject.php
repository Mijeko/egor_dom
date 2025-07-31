<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

final class ActiveValueObject extends ABoolValueObject
{
	public static function active(): ActiveValueObject
	{
		return new ActiveValueObject(true);
	}

	public static function notActive(): ActiveValueObject
	{
		return new ActiveValueObject(false);
	}
}