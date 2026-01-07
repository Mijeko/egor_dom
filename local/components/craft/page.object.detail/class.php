<?php

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\UserBehavior\Application\Dto\AddProductInViewedDto;
use Craft\DDD\UserBehavior\Application\Factory\AddProductInViewedUseCaseFactory;
use Craft\DDD\UserBehavior\Application\UseCase\AddProductInViewedUseCase;
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
use Craft\Helper\Criteria;
use Craft\Model\CraftUser;

class CraftPageBuildObjectDetailComponent extends CBitrixComponent
{

	protected ?BuildObjectService $buildObjectService;
	protected AddProductInViewedUseCase $addProductInViewedUseCase;

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
				/* @var BuildObjectDto $entity */
				$entity = $this->arResult['BUILD_OBJECT_DTO'];

				$this->addProductInViewedUseCase->execute(
					new AddProductInViewedDto(
						$this->arParams['ELEMENT_ID'],
						CraftUser::load()->getId(),
						$entity->name,
						$entity->detailLink,
					)
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
		$this->addProductInViewedUseCase = AddProductInViewedUseCaseFactory::getUseCase();
	}

	protected function loadData(): void
	{
		$buildObjectEntity = $this->buildObjectService->findById($this->arParams['ELEMENT_ID']);
		if(!$buildObjectEntity)
		{
			throw new Exception('Element not found');
		}

		$this->arResult['BUILD_OBJECT_DTO'] = $buildObjectEntity;
		$this->arResult['SIMILAR'] = $this->buildObjectService->findAll(
			Criteria::instance()
				->limit(10)
				->filter([
					BuildObjectTable::F_DEVELOPER_ID => $buildObjectEntity->developer->id,
					'!' . BuildObjectTable::F_ID     => $buildObjectEntity->id,
				])
		);
	}
}