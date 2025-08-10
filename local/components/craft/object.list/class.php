<?php

use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\DDD\Shared\Presentation\Dto\LocationDto;
use Craft\Dto\BxImageDto;

class CraftBuildObjectListComponent extends CBitrixComponent
{
	protected ?BuildObjectRepositoryInterface $buildObjectRepository = null;
	protected ImageServiceInterface $imageService;

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

		$buildObjectList = $this->buildObjectRepository->findAll();
		$apartmentList = [];
		$developerList = [];

		$buildObjectListDto = array_map(function(BuildObjectEntity $bo) {
			return new BuildObjectDto(
				$bo->getId(),
				$bo->getName(),
				$bo->getType(),
				$bo->getFloors(),
				null,
				array_map(function(int $imageId) {
					$res = $this->imageService->fromId($imageId);
					return new BxImageDto(
						$res->id,
						$res->src,
					);
				}, $bo->getGalleryIdList()),
				null,
				LocationDto::fromModel($bo->getLocation()),
				'/objects/' . $bo->getId() . '/',
			);
		}, $buildObjectList);

		$this->arResult['BUILD_OBJECTS'] = $buildObjectListDto;
	}

	protected function loadService(): void
	{
		$this->buildObjectRepository = new OrmBuildObjectRepository();
		$this->imageService = new ImageService();
	}
}