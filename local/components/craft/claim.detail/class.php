<?php

use Craft\DDD\Claims\Application\Services\ClaimService;
use Craft\DDD\Claims\Application\Factory\ClaimServiceFactory;

class CraftClaimDetailComponent extends CBitrixComponent
{

	protected ClaimService $claimRepository;

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
		$this->claimRepository = ClaimServiceFactory::getClaimService();
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