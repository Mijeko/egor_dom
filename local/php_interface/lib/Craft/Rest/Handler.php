<?php

namespace Craft\Rest;

class Handler
{
	const SCOPE_USER = 'user';

	public static function onRestServiceBuildDescription()
	{
		return [
			static::SCOPE_USER => [
				'user.register' => [RegistrationRest::class, 'register'],
				'user.auth'     => [RegistrationRest::class, 'authorize'],
			],
		];
	}
}