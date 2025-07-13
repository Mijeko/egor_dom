<?php

namespace Craft\Rest;

use Craft\DDD\Claims\Application\Dto\ClaimCreateDto;
use Craft\DDD\Claims\Application\Factory\ClaimCreateUseCaseFactory;
use Craft\DDD\Claims\Application\Factory\ClaimServiceFactory;
use Craft\DDD\Claims\Application\Factory\NotifyManagerAboutFreshClaimFactory;
use Craft\DDD\Claims\Present\Dto\ClaimDto;

class ClaimRest extends \IRestService
{
	public static function create($query, $nav, \CRestServer $server)
	{
		try
		{
			$service = ClaimServiceFactory::getClaimService();
			$claim = $service->createClientClaim(new ClaimCreateDto(
				$query['apartmentId'],
				$query['userId'],
				$query['email'],
				$query['phone'],
				$query['client'],
				$query['inn'],
				$query['kpp'],
				$query['bik'],
				$query['ogrn'],
				$query['currAccount'],
				$query['corrAccount'],
				$query['legalAddress'],
				$query['postAddress'],
				$query['bankName'],
			));

			return [
				'success' => true,
				'claim'   => ClaimDto::fromEntity($claim),
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