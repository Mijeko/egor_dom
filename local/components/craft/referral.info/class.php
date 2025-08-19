<?php

use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Referal\Infrastructure\Repository\ReferralRepository;
use Craft\DDD\Referal\Presentantion\Dto\ReferralDto;
use Craft\Helper\CurrencyHtml;
use Craft\Helper\Money;

class CraftReferralInfoComponent extends CBitrixComponent
{

	protected ReferralRepositoryInterface $referralRepository;

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

		}
	}

	private function loadServices(): void
	{
		$this->referralRepository = new ReferralRepository();
	}

	private function loadData(): void
	{
		$this->arResult['REFERRAL'] = new ReferralDto(
			'https://abn.ru/ref/391030',
			3,
			Money::format(300000) . ' ' . CurrencyHtml::icon()
		);
	}
}