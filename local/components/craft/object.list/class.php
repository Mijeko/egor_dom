<?php

use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Application\Factory\BuildObjectServiceFactory;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;

class CraftBuildObjectListComponent extends CBitrixComponent
{
	protected ?BuildObjectService $service = null;

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
		$this->arResult['BUILD_OBJECTS'] = array_map(
			function(BuildObjectEntity $buildObject) {
				return BuildObjectDto::fromModel($buildObject);
			},
			$this->service->findAll(
				[],
				$this->arParams['FILTER'],
			)
		);
	}

	protected function loadService(): void
	{
		if($this->arParams['IBLOCK_ID'])
		{
			$this->service = BuildObjectServiceFactory::createOnIblock($this->arParams['IBLOCK_ID']);
		} else
		{
			$this->service = BuildObjectServiceFactory::createOnOrm();
		}
	}
}