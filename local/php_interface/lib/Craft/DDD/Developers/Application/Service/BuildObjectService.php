<?php

namespace Craft\DDD\Developers\Application\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;

class BuildObjectService
{
	public function __construct(
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected DeveloperService               $developerService,
		protected ApartmentRepositoryInterface   $apartmentRepository,
	)
	{
	}

	public function create(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity
	{
		return $this->buildObjectRepository->create($buildObjectEntity);
	}

	public function findById(int $id): ?BuildObjectEntity
	{

		$buildObject = $this->buildObjectRepository->findById($id);

		if(!$buildObject)
		{
			throw new \Exception('Объект недвижимости не найден');
		}

		$apartmentList = $this->apartmentRepository->findAll(
			[],
			[
				ApartmentTable::F_BUILD_OBJECT_ID => $buildObject->getId(),
			]
		);

		foreach($apartmentList as $apartment)
		{
			$buildObject->addApartment($apartment);
		}

		$developer = $this->developerService->findById($buildObject->getDeveloperId());
		if($developer)
		{
			$buildObject->addDeveloper($developer);
		}


		return $buildObject;
	}

	public function findByName(string $name): ?BuildObjectEntity
	{
		return $this->buildObjectRepository->findByName($name);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		$buildObjectList = $this->buildObjectRepository->findAll($order, $filter);
		$idList = array_map(function(BuildObjectEntity $buildObject) {
			return $buildObject->getId();
		}, $buildObjectList);

		$developerList = $this->developerService->findAll(
			$order,
			[
				BuildObjectTable::F_ID => $idList,
			]
		);

		$buildObjectList = array_map(function(BuildObjectEntity $buildObject) use ($developerList) {
			$currentDeveloper = array_filter($developerList, function(DeveloperEntity $developer) use ($buildObject) {
				return $buildObject->getDeveloperId() === $developer->getId();
			});

			if(count($currentDeveloper) == 1)
			{
				$currentDeveloper = array_shift($currentDeveloper);
				$buildObject->addDeveloper($currentDeveloper);
			}

			return $buildObject;

		}, $buildObjectList);

		return $buildObjectList;

	}
}