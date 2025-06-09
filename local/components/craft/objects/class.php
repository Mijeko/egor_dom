<?php

use Craft\DDD\Objects\Application\Service\BuildObjectService;
use Craft\DDD\Objects\Application\Service\BuildObjectServiceFactory;

class CraftBuildObjectsComponent extends CBitrixComponent
{
	protected ?BuildObjectService $service = null;

	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{
			$this->loadService();
			$this->loadData();
			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	protected function loadData(): void
	{
		$this->arResult['BUILD_OBJECTS'] = $this->service->findAll();
	}

	protected function loadService(): void
	{
		$this->service = BuildObjectServiceFactory::create();
	}
}