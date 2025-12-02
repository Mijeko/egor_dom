<?php

use Bitrix\Main\Diag\Debug;
use Craft\DDD\UserBehavior\Application\Factory\AddProductInFavoriteUseCaseFactory;
use Craft\DDD\UserBehavior\Application\UseCase\AddProductInFavoriteUseCase;
use Craft\DDD\UserBehavior\Infrastructure\Repository\ProductViewedRepository;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\Dto\BxImageDto;
use Craft\DDD\Developers\Present\Dto\ApartmentDto;
use Craft\DDD\Shared\Presentation\Dto\LocationDto;
use Craft\DDD\Developers\Present\Dto\DeveloperDto;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Application\Factory\ApartmentServiceFactory;
use Craft\DDD\Developers\Application\Factory\DeveloperServiceFactory;
use Craft\DDD\Developers\Application\Factory\BuildObjectServiceFactory;
use Craft\Model\CraftUser;

class CraftPageBuildObjectDetailComponent extends CBitrixComponent
{

	protected ?BuildObjectService $buildObjectService;
	protected AddProductInFavoriteUseCase $favoriteUseCase;

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
			$this->freeSpaceWork();
			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			Debug::dump($e->getMessage());
		}
	}

	protected function freeSpaceWork(): void
	{
		try
		{

			if(CraftUser::load()?->getId())
			{
				$this->favoriteUseCase->execute(
					$this->arParams['ELEMENT_ID'],
					CraftUser::load()->getId()
				);
			}
		} catch(Exception|TypeError $e)
		{
		}
	}

	protected function meta(): void
	{
		/* @var $element BuildObjectDto */
		$element = $this->arResult['BUILD_OBJECT_DTO'];

		global $APPLICATION;

		$APPLICATION->SetTitle($element->name);
		$APPLICATION->AddChainItem($element->name);
	}

	protected function loadService(): void
	{
		$this->buildObjectService = BuildObjectServiceFactory::createOnOrm();
		$this->favoriteUseCase = AddProductInFavoriteUseCaseFactory::getUseCase();
	}

	protected function loadData(): void
	{
		$buildObjectEntity = $this->buildObjectService->findById($this->arParams['ELEMENT_ID']);
		if(!$buildObjectEntity)
		{
			throw new Exception('Element not found');
		}

		$this->arResult['BUILD_OBJECT_DTO'] = $buildObjectEntity;
	}
}