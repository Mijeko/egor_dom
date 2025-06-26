<?php

namespace Craft\Rest;

use Craft\DDD\Claims\Application\Services\ClaimServiceFactory;
use Craft\DDD\Claims\Domain\Entity\Claim;
use Craft\DDD\Objects\Infrastructure\Repository\OrmBuildObjectRepository;
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
				$query['inn'],
				$query['kpp'],
				$query['bik'],
				$query['ogrn'],
				$query['currAcc'],
				$query['corrAcc'],
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