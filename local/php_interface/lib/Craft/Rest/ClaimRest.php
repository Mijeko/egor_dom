<?php

namespace Craft\Rest;

use Craft\DDD\Claims\Application\Services\ClaimServiceFactory;
use Craft\DDD\Claims\Domain\Entity\Claim;
use Craft\DDD\Objects\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\User\Infrastructure\Repository\UserRepository;

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

			$userRepository = new UserRepository();
			if(!$user = $userRepository->findById($query['userId']))
			{
				throw new \Exception('User not found');
			}

			$claim = Claim::createClaim(
				'',
				$buildObject,
				$user
			);

			$service = ClaimServiceFactory::getClaimService();
			$service->create($claim);

			return [
				rand() => rand(),
			];
		} catch(\Exception $e)
		{

		}
	}
}