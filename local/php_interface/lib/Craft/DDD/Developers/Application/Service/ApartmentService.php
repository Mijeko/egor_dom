<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;

class ApartmentService
{

	public function __construct(
		protected ApartmentRepositoryInterface   $apartmentRepository,
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected ImageServiceInterface          $imageService,
	)
	{
	}

	public function findAllByBuildObjectId(int $buildObjectId): array
	{
		$apartmentList = $this->findAll(
			[],
			[
				ApartmentTable::F_BUILD_OBJECT_ID => $buildObjectId,
			]
		);

		$this->loadRelations($apartmentList);

		return $apartmentList;
	}

	public function findAll(array $order = [], array $filters = []): array
	{
		$apartmentList = $this->apartmentRepository->findAll($order, $filters);
		$this->loadRelations($apartmentList);
		return $apartmentList;
	}

	public function findByExternalId(string $externalId): ?ApartmentEntity
	{
		$_apartmentList = $this->apartmentRepository->findAll(
			[],
			[
				ApartmentTable::F_EXTERNAL_ID => $externalId,
			]
		);

		if(count($_apartmentList) != 1)
		{
			return null;
		}

		$this->loadRelations($_apartmentList);

		$_apartment = array_shift($_apartmentList);
		if(!$_apartment instanceof ApartmentEntity)
		{
			return null;
		}

		return $_apartment;
	}

	public function create(ApartmentEntity $apartment): ApartmentEntity
	{

		if($buildObjectEntity = $apartment->getBuildObject())
		{
			$_buildObject = $this->buildObjectRepository->findByName($buildObjectEntity->getName());

			if(!$_buildObject)
			{
				$_buildObject = $this->buildObjectRepository->create($buildObjectEntity);
				if(!$_buildObject)
				{
					throw new \RuntimeException("Ошибка создания объекта недвижимости");
				}
			}

			$apartment->getBuildObject()->refreshId($_buildObject->getId());
		}

		return $this->apartmentRepository->create($apartment);
	}

	public function update(ApartmentEntity $apartment): ApartmentEntity
	{
		return $this->apartmentRepository->update($apartment);
	}

	private function loadRelations(array &$apartmentList): void
	{
		$buildObjectIdList = array_map(function(ApartmentEntity $apartment) {
			return $apartment->getBuildObjectId();
		}, $apartmentList);

		$buildObjectList = $this->buildObjectRepository->findAll(
			[],
			[
				BuildObjectTable::F_ID => $buildObjectIdList,
			]
		);


		$apartmentList = array_map(function(ApartmentEntity $apartment) use ($buildObjectList) {

			$currentBuildObject = array_filter($buildObjectList, function(BuildObjectEntity $buildObjectEntity) use ($apartment) {
				return $buildObjectEntity->getId() == $apartment->getBuildObjectId();
			});

			if(count($currentBuildObject) == 1)
			{
				$currentBuildObject = array_shift($currentBuildObject);
				$apartment->setBuildObject($currentBuildObject);
			}

			return $apartment;

		}, $apartmentList);

		$apartmentList = array_map(function(ApartmentEntity $apartment) {

			$planImagesIdList = $apartment->getPlanImagesIdList();
			$planImages = array_map(function(int $imageId) {
				$image = $this->imageService->fromId($imageId);
				return new ImageValueObject(
					$image->id,
					$image->src,
				);
			}, $planImagesIdList);
			$planImages = array_filter($planImages);

			$apartment->addPlanImage(new ImageGalleryValueObject($planImages));


			$galleryImagesIdList = $apartment->getGalleryIdList();
			$galleryImages = array_map(function(int $imageId) {
				$image = $this->imageService->fromId($imageId);
				return new ImageValueObject(
					$image->id,
					$image->src,
				);
			}, $galleryImagesIdList);
			$galleryImages = array_filter($galleryImages);

			$apartment->addGalleryImage(new ImageGalleryValueObject($galleryImages));


			return $apartment;
		}, $apartmentList);
	}
}