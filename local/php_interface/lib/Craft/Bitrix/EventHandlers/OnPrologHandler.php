<?php

namespace Craft\Bitrix\EventHandlers;

use Craft\DDD\User\Application\Factory\CurrentUserFactory;

class OnPrologHandler
{
	public static function handle(): void
	{
		self::initVueUser();
	}

	private static function initVueUser(): void
	{
		$cu = CurrentUserFactory::getService();
		$user = $cu->get();

		if($user)
		{
			inertia()->share('user', $user);
		}
	}
}