<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\City\Infrastructure\Service\CurrentCityService;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;

class BuildObjectService
{
	public function __construct(
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected DeveloperRepositoryInterface   $developerRepository,
		protected ApartmentRepositoryInterface   $apartmentRepository,
		protected CurrentCityService             $currentCityService,
		protected ImageServiceInterface          $imageService,
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

	public function findAllByDeveloperIds(array $developerIds): array
	{
		return $this->findAll(
			[],
			[
				BuildObjectTable::F_DEVELOPER_ID => $developerIds,
			]
		);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		$buildObjectList = $this->buildObjectRepository->findAll();

		$this->loadRelations($buildObjectList);

		return $buildObjectList;

	}

	private function loadRelations(array &$buildObjectList): void
	{

		// ===============================GALLERY:==============================================
		$buildObjectList = array_map(function(BuildObjectEntity $buildObjectEntity) {

			$images = array_map(function(int $imageId) {

				$image = $this->imageService->findById($imageId);

				if(!$image->id)
				{
					return null;
				}

				return new ImageValueObject(
					$image->id,
					$image->src,
				);
			}, $buildObjectEntity->getGalleryIdList());
			$images = array_filter($images);


			$vo = new ImageGalleryValueObject($images);
			$buildObjectEntity->addGalleryImage($vo);

			return $buildObjectEntity;

		}, $buildObjectList);
		// ===============================GALLERY;==============================================


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
			$buildObjectList = array_map(function(BuildObjectEntity $buildObjectEntity) use ($developers) {

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
			$buildObjectList = array_map(function(BuildObjectEntity $buildObjectEntity) use ($apartments) {

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
