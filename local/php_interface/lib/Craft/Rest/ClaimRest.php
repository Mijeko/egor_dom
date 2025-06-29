<?php

namespace Craft\Rest;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Claims\Application\Services\ClaimServiceFactory;
use Craft\DDD\Claims\Domain\Entity\Claim;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;

class ClaimRest extends \IRestService
{
	public static function create($query, $nav, \CRestServer $server)
	{
		try
		{
			$buildObjectRepository = new OrmBuildObjectRepository();
			$buildObject = $buildObjectRepository->findById($query['buildObjectId']);
			if(!$buildObject)
			{
				throw new \Exception('Build object not found');
			}

			$userRepository = new BxUserRepository();
			if(!$user = $userRepository->findById($query['userId']))
			{
				throw new \Exception('User not found');
			}

			$claim = Claim::createClaim(
				'Заявка от ' . date('d.m.Y H:i:s'),
				$query['email'],
				$query['phone'],
				$query['client'],
				intval($query['inn']),
				intval($query['kpp']),
				intval($query['bik']),
				intval($query['ogrn']),
				$query['currAccount'],
				$query['corrAccount'],
				$query['legalAddress'],
				$query['postAddress'],
				$query['bankName'],
				$buildObject,
				$user
			);

			$service = ClaimServiceFactory::getClaimService();
			$claim = $service->create($claim);


			return [
				'success' => true,
				'claim'   => $claim,
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