<?php

namespace Craft\Helper;

use Bitrix\Main\Diag\Debug;

class DigitsValidateHelper
{
	public static function validateDigits(string $value, int $countDigits): bool
	{
		preg_match_all('/\d+/', $value, $matches);

		Debug::dumpToFile($matches);

		if(empty($matches[0]))
		{
			return false;
		}


		return mb_strlen($matches[0]) == $countDigits;
	}
}