<?php

use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;
use Craft\DDD\Referal\Application\Factory\ReferralInformationServiceFactory;
use Craft\DDD\Referal\Application\Service\ReferralInformationService;
use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Referal\Infrastructure\Repository\ReferralRepository;
use Craft\DDD\Referal\Presentantion\Dto\ReferralInformationDto;
use Craft\Helper\CurrencyHtml;
use Craft\Helper\Money;
use Craft\Helper\Url;

class CraftReferralInfoComponent extends CBitrixComponent
{
	private ReferralInformationService $referralInformationService;

	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{

			$this->loadServices();
			$this->loadData();

			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			Debug::dumpToFile($e->getMessage());
		}
	}

	private function loadServices(): void
	{
		$this->referralInformationService = ReferralInformationServiceFactory::getService();
	}

	private function loadData(): void
	{
		$this->arResult['REFERRAL'] = $this->referralInformationService->obtainInformationByUserId(
			$this->arParams['USER_ID']
		);
	}
}