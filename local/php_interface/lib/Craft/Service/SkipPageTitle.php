<?php

namespace Craft\Service;

class SkipPageTitle
{
	public static function skip(): bool
	{
		if(self::checkFullPath())
		{
			return true;
		}

		if(self::checkPartPath())
		{
			return true;
		}

		return false;
	}

	public static function checkFullPath(): bool
	{
		global $APPLICATION;
		return in_array($APPLICATION->GetCurPage(), [
			'/profile/',
			'/profile/orders/',
		]);
	}

	public static function checkPartPath(): bool
	{
		global $APPLICATION;
		foreach(['/profile/'] as $part)
		{
			if(strripos($APPLICATION->GetCurPage(), $part) !== false)
			{
				return true;
			}
		}

		return false;
	}
}