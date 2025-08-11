<?php

use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\DDD\Shared\Presentation\Dto\LocationDto;
use Craft\Dto\BxImageDto;

class CraftBuildObjectListComponent extends CBitrixComponent
{
	protected ApartmentRepositoryInterface $apartmentRepository;
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

		$buildObjectListDto = array_map(function(BuildObjectEntity $buildObjectEntity) {
			return new BuildObjectDto(
				$buildObjectEntity->getId(),
				$buildObjectEntity->getName(),
				$buildObjectEntity->getType(),
				$buildObjectEntity->getFloors(),
				null,
				array_map(function(int $imageId) {
					$res = $this->imageService->findById($imageId);
					return new BxImageDto(
						$res->id,
						$res->src,
					);
				}, $buildObjectEntity->getGalleryIdList()),
				null,
				LocationDto::fromModel($buildObjectEntity->getLocation()),
				'/objects/' . $buildObjectEntity->getId() . '/',
				$this->apartmentRepository->countByBuildObjectId($buildObjectEntity->getId()),
			);
		}, $buildObjectList);

		$this->arResult['BUILD_OBJECTS'] = $buildObjectListDto;
	}

	protected function loadService(): void
	{
		$this->imageService = new ImageService();
		$this->apartmentRepository = new OrmApartmentRepository();
		$this->buildObjectRepository = new OrmBuildObjectRepository();
	}
}