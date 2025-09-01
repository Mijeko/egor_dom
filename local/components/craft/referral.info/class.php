<?php

use Bitrix\Main\Application;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;
use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Referal\Infrastructure\Repository\ReferralRepository;
use Craft\DDD\Referal\Presentantion\Dto\ReferralDto;
use Craft\Helper\CurrencyHtml;
use Craft\Helper\Money;
use Craft\Helper\Url;

class CraftReferralInfoComponent extends CBitrixComponent
{
	protected ReferralRepositoryInterface $referralRepository;
	protected ClaimRepositoryInterface $claimRepository;

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
			\Bitrix\Main\Diag\Debug::dumpToFile($e->getMessage());
		}
	}

	private function loadServices(): void
	{
		$this->referralRepository = new ReferralRepository();
		$this->claimRepository = new OrmClaimRepository();
	}

	private function loadData(): void
	{
		$referralInfo = $this->referralRepository->findByUserId($this->arParams['USER_ID']);
		if(!$referralInfo)
		{
			return;
		}

		$invitedMembers = $this->referralRepository->findAllInvitedMembers($referralInfo->getId());

		$idInvitedMemberList = array_map(function(ReferralEntity $ref) {
			return $ref->getId();
		}, $invitedMembers);

		$claimList = $this->claimRepository->findAll([], [
			ClaimTable::F_USER_ID => $idInvitedMemberList,
		]);

		$costAward = array_reduce($claimList, function($store, ClaimEntity $item) {
			if(
				$item->getStatus()->isFinished()
				&& !$item->getIsMoneyReceived()
			)
			{
				$store += $item->getOrderCost();
			}
			return $store;
		}, 0);

		$this->arResult['REFERRAL'] = new ReferralDto(
			sprintf(
				'%s/ref/%s',
				Url::getFullUrl(),
				$referralInfo->getCode()
			),
			count($invitedMembers),
			Money::format($costAward) . ' ' . CurrencyHtml::icon()
		);
	}
}