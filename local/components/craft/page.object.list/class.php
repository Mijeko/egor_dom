<?php

use Craft\DDD\Developers\Application\Factory\BuildObjectServiceFactory;
use Craft\DDD\Developers\Application\Service\BuildObjectService;

class CraftPageBuildObjectListComponent extends CBitrixComponent
{
	protected ?BuildObjectService $buildObjectService = null;

	public function onPrepareComponentParams($arParams)
	{
		$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
		$arParams['FILTER'] = is_array($arParams['FILTER']) ? $arParams['FILTER'] : [];
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{
			$this->loadService();
			$this->loadData();
			$this->includeComponentTemplate();
		} catch(Exception $exception)
		{
			echo $exception->getMessage();
		}
	}

	protected function loadData(): void
	{
		$this->arResult['BUILD_OBJECTS'] = $this->buildObjectService->findAll();
	}

	protected function loadService(): void
	{
		$this->buildObjectService = BuildObjectServiceFactory::createOnOrm();
	}
}