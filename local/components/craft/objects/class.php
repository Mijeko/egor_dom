<?php

use Craft\DDD\Objects\Domain\Entity\BuildObject;
use Craft\DDD\Objects\Application\Service\BuildObjectService;
use Craft\DDD\Objects\Application\Service\BuildObjectServiceFactory;
use Craft\DDD\Objects\Infrastructure\Dto\BuildObjectFrontDto;

class CraftBuildObjectsComponent extends CBitrixComponent
{
	protected ?BuildObjectService $service = null;

	public function onPrepareComponentParams($arParams)
	{
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
		} catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	protected function loadData(): void
	{
		$this->arResult['BUILD_OBJECTS'] = array_map(
			function(BuildObject $service) {
				return BuildObjectFrontDto::fromModel($service);
			},
			$this->service->findAll([
				'filter' => array_merge(
					[],
					$this->arParams['FILTER']
				),
			])
		);
	}

	protected function loadService(): void
	{
		$this->service = BuildObjectServiceFactory::create();
	}
}