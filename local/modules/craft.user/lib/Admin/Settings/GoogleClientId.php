<?php

namespace Craft\User\Admin\Settings;

class GoogleClientId extends Setting
{

	private static $instance = null;

	public static function instance(): self
	{
		if(is_null(self::$instance))
		{
			self::$instance = new static();
		}

		return self::$instance;
	}

	public function name(): string
	{
		return 'GOOGLE_CLIENT_ID';
	}

	public function label(string $key): ?string
	{
		return null;
	}
}