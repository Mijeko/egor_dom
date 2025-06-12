<?php

namespace Craft\Rest;

use Craft\DDD\User\Application\Dto\ProfileUpdateServiceDto;
use Craft\DDD\User\Application\Service\Factory\AuthorizeServiceFactory;
use Craft\DDD\User\Application\Service\Factory\UpdateProfileServiceFactory;

class UserRest extends \IRestService
{
	public static function login($query, $nav, \CRestServer $server): array
	{
		try
		{
			$service = AuthorizeServiceFactory::create();
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

	public static function profileUpdate($query, $nav, \CRestServer $server)
	{
		try
		{
			$profileId = $query['profileId'];
			if(!$profileId)
			{
				throw new \Exception('Profile id is required');
			}

			unset($query['profileId']);

			$service = UpdateProfileServiceFactory::create();
			$service->execute(intval($profileId), ProfileUpdateServiceDto::fromArray($query));

			return [
				'success' => true,
				'message' => 'Успешно',
			];

		} catch(\Exception $e)
		{
			return [
				'success' => false,
				'error'   => $e->getMessage(),
			];
		}
	}
}