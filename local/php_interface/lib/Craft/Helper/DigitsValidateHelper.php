<?php

namespace Craft\Helper;

class DigitsValidateHelper
{
	public static function validateDigits(string $value, int $countDigits): bool
	{
		$matchValue = preg_replace('/\D+/', '', $value);

		if(empty($matchValue))
		{
			return false;
		}

		return mb_strlen($matchValue) == $countDigits;
	}
}