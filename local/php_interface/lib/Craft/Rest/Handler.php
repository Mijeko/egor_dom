<?php

namespace Craft\Rest;

class Handler
{
	const SCOPE_CRAFT = 'craft';

	public static function onRestServiceBuildDescription()
	{
		return [
			static::SCOPE_CRAFT => [
				'user.login'            => [UserRest::class, 'login'],
				'user.register.student' => [UserRest::class, 'registerStudent'],
				'user.register.agent'   => [UserRest::class, 'registerAgent'],
				'profile.update'        => [UserRest::class, 'profileUpdate'],
				'profile.find'          => [UserRest::class, 'findProfile'],
				'claim.create'          => [ClaimRest::class, 'create'],
				'city.current.store'    => [CityRest::class, 'storeCurrentCity'],
			],
		];
	}
}