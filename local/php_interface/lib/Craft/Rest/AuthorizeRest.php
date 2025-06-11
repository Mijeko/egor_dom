<?php


namespace Craft\Rest;

use Craft\DDD\User\Application\Service\Factory\AuthorizeServiceFactory;

class AuthorizeRest extends \IRestService
{
	public static function login($query, $nav, \CRestServer $server): array
	{
		try
		{
			$service = AuthorizeServiceFactory::createService();
			if($service->execute($query['phone'], $query['password']))
			{
				return [
					'success'  => true,
					'redirect' => '/',
				];
			}
		} catch(\Exception $e)
		{
			return [
				'success' => false,
				'error'   => $e->getMessage(),
			];
		}

		return [
			'success' => false,
		];
	}
}