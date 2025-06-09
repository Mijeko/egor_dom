<?php

use Craft\DDD\Objects\Application\Service\BuildObjectService;
use Craft\DDD\Objects\Infrastructure\Dto\BuildObjectDetailDto;
use Craft\DDD\Objects\Application\Service\BuildObjectServiceFactory;

class CraftBuildObjectsDetailComponent extends CBitrixComponent
{

	protected ?BuildObjectService $service;

	public function onPrepareComponentParams($arParams)
	{
		$apParams['ELEMENT_ID'] = intval($arParams['ELEMENT_ID']);
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{
			$this->loadService();
			$this->loadData();
			$this->meta();
			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			\Bitrix\Main\Diag\Debug::dump($e->getMessage());
		}
	}

	protected function meta(): void
	{
		/* @var $element BuildObjectDetailDto */
		$element = $this->arResult['ELEMENT'];

		global $APPLICATION;

		$APPLICATION->SetTitle($element->name);
	}

	protected function loadService(): void
	{
		$this->service = BuildObjectServiceFactory::create();
	}

	protected function loadData(): void
	{
		$element = $this->service->findById($this->arParams['ELEMENT_ID']);

		if(!$element)
		{
			throw new Exception('Element not found');
		}

		$this->arResult['ELEMENT'] = new BuildObjectDetailDto(
			$element->getId(),
			$element->getName(),
		);
	}
}