<?php

use Craft\DDD\Apartment\Domain\Entity\ApartmentEntity;
use Craft\DDD\Apartment\Infrastructure\Dto\ApartmentDto;
use Craft\DDD\Objects\Application\Service\BuildObjectService;
use Craft\DDD\Objects\Infrastructure\Dto\BuildObjectDetailDto;
use Craft\DDD\Objects\Application\Service\BuildObjectServiceFactory;

class CraftBuildObjectDetailComponent extends CBitrixComponent
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
		$APPLICATION->AddChainItem($element->name);
	}

	protected function loadService(): void
	{
		$this->service = BuildObjectServiceFactory::createOnOrm();
		//		$this->service = BuildObjectServiceFactory::createOnIblock(BUILD_OBJECT_IBLOCK_ID);
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
			$element->getPicture(),
			$element->getGallery(),
			array_map(
				function(ApartmentEntity $item) {
					return new ApartmentDto(
						$item->getId(),
						$item->getName(),
						$item->getPrice(),
						$item->getBuildObjectId(),
					);
				},
				$element->getApartments()
			),
		);
	}
}