<?php

namespace Craft\Rest;

class Handler
{
	const SCOPE_CRAFT = 'craft';

	public static function onRestServiceBuildDescription()
	{
		return [
			static::SCOPE_CRAFT => [
				'user.login'     => [UserRest::class, 'login'],
				'user.register'  => [UserRest::class, 'register'],
				'profile.update' => [UserRest::class, 'profileUpdate'],
			],
		];
	}
}