<?php

namespace Craft\Rest;

use Craft\DDD\Claims\Application\Dto\ClaimCreateDto;
use Craft\DDD\Claims\Application\Factory\ClaimCreateUseCaseFactory;
use Craft\DDD\Claims\Application\Factory\NotifyManagerAboutFreshClaimFactory;

class ClaimRest extends \IRestService
{
	public static function create($query, $nav, \CRestServer $server)
	{
		try
		{

			$claimCreateUseCase = ClaimCreateUseCaseFactory::getService();
			$notifyManagerAboutFreshClaim = NotifyManagerAboutFreshClaimFactory::getService();

			$claim = $claimCreateUseCase->execute(new ClaimCreateDto(
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

			$notifyManagerAboutFreshClaim->execute($claim);

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