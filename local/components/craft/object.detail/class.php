<?php

use Craft\Dto\BxImageDto;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Developers\Present\Dto\ApartmentDto;
use Craft\DDD\Developers\Present\Dto\DeveloperDto;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\Developers\Application\Service\Factory\BuildObjectServiceFactory;

class CraftBuildObjectDetailComponent extends CBitrixComponent
{

	protected ?BuildObjectService $buildObjectService;

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
	}

	protected function loadData(): void
	{
		$element = $this->buildObjectService->findById($this->arParams['ELEMENT_ID']);
		if(!$element)
		{
			throw new Exception('Element not found');
		}


		$this->arResult['ELEMENT'] = BuildObjectDto::fromModel($element);
	}
}