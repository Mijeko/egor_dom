<?php

namespace Craft\User\Admin\Settings;

class GoogleRedirectUrl extends Setting
{
	private static ?GoogleRedirectUrl $instance = null;

	public static function instance(): SettingInterface
	{
		if(is_null(self::$instance))
		{
			self::$instance = new static();
		}

		return self::$instance;
	}

	public function name(): string
	{
		return 'GOOGLE_REDIRECT_URL';
	}

	public function label(string $key): ?string
	{
		return 'Google Redirect URL';
	}
}