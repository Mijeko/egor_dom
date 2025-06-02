<?php

namespace Craft\Translate\Service;

class TranslateText
{
	protected static $instance;

	public static function instance(): TranslateText
	{
		if(is_null(self::$instance))
		{
			self::$instance = new TranslateText();
		}

		return self::$instance;
	}

	public function translate($text): ?string
	{
		return null;
	}
}