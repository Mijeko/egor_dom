<?php

use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;

class CraftClaimsDetailComponent extends CBitrixComponent
{

	protected ClaimRepositoryInterface $claimRepository;

	public function onPrepareComponentParams($arParams)
	{
		$arParams['ID'] = intval($arParams['ID']);

		return $arParams;
	}

	public function executeComponent()
	{
		try
		{

			$this->loadServices();
			$this->loadData();
			$this->meta();

			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	protected function loadServices(): void
	{
		$this->claimRepository = new OrmClaimRepository();
	}

	protected function loadData(): void
	{
		$this->arResult['CLAIM'] = $this->claimRepository->findById($this->arParams['ID']);
	}

	protected function meta(): void
	{
		global $APPLICATION;

		/* @var \Craft\DDD\Claims\Domain\Entity\ClaimEntity $claim */
		$claim = $this->arResult['CLAIM'];

		$APPLICATION->SetTitle('Заявка на приобритение ' . $claim->getApartmentEntity()->getName());
	}
}