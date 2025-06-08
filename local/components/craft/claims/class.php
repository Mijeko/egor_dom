<?php

use Craft\DDD\Claims\Application\Services\ClaimService;
use Craft\DDD\Claims\Application\Services\ClaimServiceFactory;

class CraftClaimsComponent extends CBitrixComponent
{

	protected ?ClaimService $claimService = null;

	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{

		try
		{
			$this->validateParams();
			$this->loadServices();
			$this->loadData();
			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			echo $e->getMessage();
		}


	}

	protected function loadServices(): void
	{
		$this->claimService = ClaimServiceFactory::getClaimService();
	}

	protected function loadData(): void
	{
		$this->arResult['CLAIMS'] = $this->claimService->getAllByUserId($this->arParams["USER_ID"]);
	}

	protected function validateParams(): void
	{
		if(empty($this->arParams["USER_ID"]))
		{
			throw new Exception('User ID is required');
		}
	}
}