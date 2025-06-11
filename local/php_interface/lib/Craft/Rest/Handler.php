<?php

namespace Craft\Rest;

class Handler
{
	const SCOPE_CRAFT = 'craft';

	public static function onRestServiceBuildDescription()
	{
		return [
			static::SCOPE_CRAFT => [
				'user.login'    => [AuthorizeRest::class, 'login'],
				'user.register' => [RegistrationRest::class, 'register'],
				'user.auth'     => [RegistrationRest::class, 'authorize'],
			],
		];
	}
}