<?php

namespace Craft\Rest;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Claims\Application\Dto\ClaimCreateDto;
use Craft\DDD\Claims\Application\Factory\ClaimCreateUseCaseFactory;
use Craft\DDD\Claims\Application\Factory\NotifyManagerAboutFreshClaimFactory;
use Craft\DDD\Claims\Application\Services\ClaimServiceFactory;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;

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