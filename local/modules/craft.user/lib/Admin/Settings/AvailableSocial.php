<?php

namespace Craft\User\Admin\Settings;

class AvailableSocial extends Setting
{
	private static $instance = null;

	const V_GOOGLE = 'google';
	const V_VK = 'vk';
	const V_MAIL = 'mailru';

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
		return 'AVAILABLE_SOCIAL_AUTH';
	}

	public static function list(): array
	{
		return [
			self::V_GOOGLE => 'Google',
			self::V_VK     => 'Вконтакте',
			self::V_MAIL   => 'Mail.Ru',
		];
	}

	public function label(string $key): ?string
	{
		if(array_key_exists($key, self::list()))
		{
			return static::list()[$key];
		}

		return null;
	}
}