<?php

namespace Craft\Rest;

class ClaimRest extends \IRestService
{
	public static function create($query, $nav, \CRestServer $server)
	{
		return [
			rand() => rand(),
		];
	}
}