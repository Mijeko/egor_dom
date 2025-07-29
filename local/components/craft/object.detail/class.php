<?php

use Craft\DDD\Developers\Application\Factory\DeveloperServiceFactory;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Application\Factory\ApartmentServiceFactory;
use Craft\DDD\Developers\Application\Factory\BuildObjectServiceFactory;

class CraftBuildObjectDetailComponent extends CBitrixComponent
{

	protected ?BuildObjectService $buildObjectService;
	protected ?ApartmentService $apartmentService;

	protected ?DeveloperService $developerService;

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
		/* @var $element \Craft\DDD\Developers\Present\Dto\BuildObjectDto */
		$element = $this->arResult['ELEMENT'];

		global $APPLICATION;

		$APPLICATION->SetTitle($element->name);
		$APPLICATION->AddChainItem($element->name);
	}

	protected function loadService(): void
	{
		$this->buildObjectService = BuildObjectServiceFactory::createOnOrm();
		$this->apartmentService = ApartmentServiceFactory::createOnOrm();
		$this->developerService = DeveloperServiceFactory::createOnOrm();
	}

	protected function loadData(): void
	{
		$buildObjectEntity = $this->buildObjectService->findById($this->arParams['ELEMENT_ID']);
		if(!$buildObjectEntity)
		{
			throw new Exception('Element not found');
		}

		$apartmentList = $this->apartmentService->findAllByBuildObjectId($buildObjectEntity->getId());
		$developer = $this->developerService->findById($buildObjectEntity->getDeveloperId());


		$this->arResult['BUILD_OBJECT_DTO'] = new BuildObjectDto(
			$buildObjectEntity->getId(),
			$buildObjectEntity->getName(),
			$buildObjectEntity->getType(),
			$buildObjectEntity->getFloors(),
			$developer,
			$buildObjectEntity->getGallery(),
			$apartmentList,
			$buildObjectEntity->getLocation(),
			'/objects/' . $buildObjectEntity->getId() . '/'
		);
	}
}