<?php

namespace Craft\User\Admin\Settings;

class VkRedirectUrl extends Setting
{
	private static ?VkRedirectUrl $instance = null;

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
		return 'VK_REDIRECT_URL';
	}

	public function label(string $key): ?string
	{
		return 'VK Redirect URL';
	}
}