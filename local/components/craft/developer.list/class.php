<?php

use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Present\Dto\DeveloperDto;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Developers\Application\Service\Factory\DeveloperServiceFactory;

class CraftDeveloperListComponent extends CBitrixComponent
{

	protected ?DeveloperService $developerService = null;

	public function onPrepareComponentParams($arParams)
	{
		$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
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

	protected function loadServices(): void
	{
		if($this->arParams['IBLOCK_ID'])
		{
			$this->developerService = DeveloperServiceFactory::createOnIblock($this->arParams['IBLOCK_ID']);
		} else
		{
			$this->developerService = DeveloperServiceFactory::createOnOrm();
		}
	}

	protected function loadData(): void
	{
		$this->arResult['DEVELOPERS'] = array_map(
			function(DeveloperEntity $developer) {
				return DeveloperDto::fromModel($developer);
			},
			$this->developerService->findAll()
		);
	}
}