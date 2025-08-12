<?php

namespace Craft\DDD\Developers\Application\UseCase;

use Craft\DDD\Developers\Application\Dto\ApartmentFilterDto;
use Craft\DDD\Developers\Application\Service\BuildApartmentFilter;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Present\Dto\ApartmentDto;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Presentation\Dto\LocationDto;

class ApartmentFilterUseCase
{

	public function __construct(
		protected ApartmentRepositoryInterface   $apartmentRepository,
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected ImageServiceInterface          $imageService,
	)
	{
	}

	public function execute(ApartmentFilterDto $apartmentFilterDto): array
	{

		$apartmentList = $this->apartmentRepository->findAll(
			[],
			BuildApartmentFilter::execute($apartmentFilterDto)
		);

		$buildObjectIdList = array_map(function(ApartmentEntity $ae) {
			return $ae->getBuildObjectId();
		}, $apartmentList);


		$buildObjectList = $this->buildObjectRepository->findAll(
			[],
			[
				BuildObjectTable::F_ID => $buildObjectIdList,
			],
		);

		return array_map(
			function(ApartmentEntity $apartment) use ($buildObjectList) {

				$buildObject = null;
				$filterBuildObject = array_filter($buildObjectList, function(BuildObjectEntity $buildObject) use ($apartment) {
					return $apartment->getBuildObjectId() === $buildObject->getId();
				});
				if(count($filterBuildObject) == 1)
				{
					$findBuildObject = array_shift($filterBuildObject);

					$buildObject = new BuildObjectDto(
						$findBuildObject->getId(),
						$findBuildObject->getName(),
						$findBuildObject->getType(),
						$findBuildObject->getFloors(),
						null,
						$this->imageService->transformBxByArray($findBuildObject->getGalleryIdList()),
						null,
						LocationDto::fromModel($findBuildObject->getLocation()),
						'/objects/' . $findBuildObject->getId() . '/',
						null,
					);
				}


				return new ApartmentDto(
					$apartment->getId(),
					$apartment->getBuildObjectId(),
					$apartment->getName(),
					$apartment->getPrice(),
					$apartment->getRooms(),
					$apartment->getFloor(),
					$apartment->getBuiltYear(),
					$apartment->getBuildingState()->getLabel(),
					$buildObject,
					$this->imageService->transformBxByArray($apartment->getPlanImagesIdList()),
				);
			},
			$apartmentList
		);
	}
}