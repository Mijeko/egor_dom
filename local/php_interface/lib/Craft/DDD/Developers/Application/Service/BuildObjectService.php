<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;

class BuildObjectService
{
	public function __construct(
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected DeveloperRepositoryInterface   $developerRepository,
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

		$buildObjectList = [$buildObject];

		$this->loadRelations($buildObjectList);

		return $buildObjectList[0];
	}

	public function findByName(string $name): ?BuildObjectEntity
	{
		$buildObject = $this->buildObjectRepository->findByName($name);

		$buildObjectList = [$buildObject];

		$this->loadRelations($buildObjectList);

		return $buildObjectList[0];
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		$buildObjectList = $this->buildObjectRepository->findAll($order, $filter);

		$this->loadRelations($buildObjectList);

		return $buildObjectList;

	}

	private function loadRelations(array &$buildObjectList): void
	{

		// ===============================DEVELOPERS:==============================================
		$developerIdList = array_map(function(BuildObjectEntity $buildObjectEntity) {
			return $buildObjectEntity->getDeveloperId();
		}, $buildObjectList);
		$developers = $this->developerRepository->findAll(
			[],
			[
				DeveloperTable::F_ID => $developerIdList,
			]
		);
		if($developers)
		{
			array_map(function(BuildObjectEntity $buildObjectEntity) use ($developers) {

				$currentDeveloper = array_filter($developers, function(DeveloperEntity $developer) use ($buildObjectEntity) {
					return $buildObjectEntity->getDeveloperId() === $developer->getId();
				});

				if(count($currentDeveloper) == 1)
				{
					$currentDeveloper = array_shift($currentDeveloper);
					$buildObjectEntity->addDeveloper($currentDeveloper);
				}

				return $buildObjectEntity;
			}, $buildObjectList);
		}
		// ===============================DEVELOPERS;==============================================


		// ===============================APARTMENTS:==============================================
		$buildObjectIdList = array_map(function(BuildObjectEntity $buildObjectEntity) {
			return $buildObjectEntity->getId();
		}, $buildObjectList);
		$apartments = $this->apartmentRepository->findAll(
			[],
			[
				ApartmentTable::F_BUILD_OBJECT_ID => $buildObjectIdList,
			]
		);
		if($apartments)
		{
			array_map(function(BuildObjectEntity $buildObjectEntity) use ($apartments) {

				$currentApartment = array_filter($apartments, function(ApartmentEntity $apartment) use ($buildObjectEntity) {
					return $buildObjectEntity->getId() === $apartment->getBuildObjectId();
				});

				if(count($currentApartment) > 0)
				{
					$buildObjectEntity->addApartments($currentApartment);
				}

				return $buildObjectEntity;
			}, $buildObjectList);
		}
		// ===============================APARTMENTS;==============================================
	}
}
