<?php

namespace Craft\Rest;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\User\Application\Dto\ProfileUpdateServiceDto;
use Craft\DDD\User\Application\Dto\RegisterAgentDto;
use Craft\DDD\User\Application\Dto\RegisterStudentDto;
use Craft\DDD\User\Application\Service\Factory\AuthorizeServiceFactory;
use Craft\DDD\User\Application\Service\Factory\RegisterAgentServiceFactory;
use Craft\DDD\User\Application\Service\Factory\RegisterStudentServiceFactory;
use Craft\DDD\User\Application\Service\Factory\UpdateProfileServiceFactory;
use Craft\DDD\User\Application\Service\RegisterAgentService;

class UserRest extends \IRestService
{
	public static function login($query, $nav, \CRestServer $server): array
	{
		try
		{
			$service = AuthorizeServiceFactory::getService();
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

			Debug::dumpToFile(ProfileUpdateServiceDto::fromArray($query));

			$service = UpdateProfileServiceFactory::getService();
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

	public static function findProfile($query, $nav, \CRestServer $server)
	{
		$profileId = $query['profileId'];
		if(!$profileId)
		{
			throw new \Exception('Profile id is required');
		}

		unset($query['profileId']);
	}

	public static function registerAgent($query, $nav, \CRestServer $server): array
	{
		try
		{
			$service = RegisterAgentServiceFactory::getService();
			$service->execute(
				new RegisterAgentDto(
					$query['phone'],
					$query['email'],
					$query['password'],
					$query['inn'],
					$query['kpp'],
					$query['ogrn'],
					$query['bik'],
					$query['currAcc'],
					$query['corrAcc'],
					$query['postAddress'],
					$query['legalAddress'],
					$query['bankName'],
				)
			);

			return [
				'success' => true,
			];

		} catch(\Exception $e)
		{
			return [
				'success' => false,
				'error'   => $e->getMessage(),
			];
		}
	}

	public static function registerStudent($query, $nav, \CRestServer $server)
	{
		try
		{
			$service = RegisterStudentServiceFactory::getService();
			$service->execute(
				new RegisterStudentDto(
					$query['phone'],
					$query['email'],
					$query['password'],
				)
			);

			return [
				'success' => true,
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