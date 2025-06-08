<?php

namespace Craft\Rest;

class RegistrationRest extends \IRestService
{
	public static function register($query, $nav, \CRestServer $server)
	{
		return [
			'demo' => rand(),
		];

	}

	public static function authorize($query, $nav, \CRestServer $server) { }
}