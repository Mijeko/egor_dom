<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;

class ApartmentService
{

	public function __construct(
		protected ApartmentRepositoryInterface $apartmentRepository,
		protected BuildObjectService           $buildObjectService,
	)
	{
	}

	public function findAll(array $order = [], array $filters = []): array
	{
		$apartmentList = $this->apartmentRepository->findAll($filters, $order);

		$apartmentListId = array_map(function(ApartmentEntity $apartment) {
			return $apartment->getId();
		}, $apartmentList);

		$buildObjectList = $this->buildObjectService->findAll(
			[],
			[
				BuildObjectTable::F_ID => $apartmentListId,
			]
		);

		$apartmentList = array_map(function(ApartmentEntity $apartment) use ($buildObjectList) {

			$currentBuildObject = array_filter($buildObjectList, function(BuildObjectEntity $buildObjectTable) use ($apartment) {
				return $buildObjectTable->getId() == $apartment->getBuildObjectId();
			});

			if(count($currentBuildObject) == 1)
			{
				$currentBuildObject = array_shift($buildObjectList);
				$apartment->setBuildObject($currentBuildObject);
			}

			return $apartment;

		}, $apartmentList);

		return $apartmentList;
	}

	public function create(ApartmentEntity $apartment): ApartmentEntity
	{

		if($buildObjectEntity = $apartment->getBuildObject())
		{
			$_buildObject = $this->buildObjectService->findByName($buildObjectEntity->getName());

			if(!$_buildObject)
			{
				$_buildObject = $this->buildObjectService->create($buildObjectEntity);
				if(!$_buildObject)
				{
					throw new \RuntimeException("Ошибка создания объекта недвижимости");
				}
			}

			$apartment->getBuildObject()->refreshId($_buildObject->getId());
		}

		return $this->apartmentRepository->create($apartment);
	}
}