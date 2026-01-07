<?php

namespace Craft\DDD\Referal\Application\Service;


use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Referal\Presentantion\Dto\ReferralInformationDto;
use Craft\Helper\CurrencyHtml;
use Craft\Helper\Money;
use Craft\Helper\Url;

class ReferralInformationService
{

	public function __construct(
		private ReferralRepositoryInterface $referralRepository,
		private ClaimRepositoryInterface    $claimRepository,
	)
	{
	}

	public function obtainInformationByUserId(int $userId): ?ReferralInformationDto
	{
		$referralInfo = $this->referralRepository->findByUserId($userId);
		if(!$referralInfo)
		{
			return null;
		}

		$invitedMembers = $this->referralRepository->findAllInvitedMembers($referralInfo->getId());

		$idInvitedMemberList = array_map(function(ReferralEntity $ref) {
			return $ref->getId();
		}, $invitedMembers);

		$claimList = $this->claimRepository->findAll();

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


		return new ReferralInformationDto(
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