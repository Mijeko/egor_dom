<?php

namespace Craft\DDD\Developers\Application\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\City\Domain\Repository\CityRepositoryInterface;
use Craft\DDD\City\Infrastructure\Entity\CityTable;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Infrastructure\Exceptions\NotFoundOrmElement;

class DeveloperService
{
	public function __construct(
		protected DeveloperRepositoryInterface   $developerRepository,
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected CityRepositoryInterface        $cityRepository,
		protected ImageServiceInterface          $imageService,
	)
	{
	}

	public function findById(int $id): ?DeveloperEntity
	{
		$developer = $this->developerRepository->findById($id);

		if(!$developer)
		{
			throw new NotFoundOrmElement('Застройщик не найден');
		}

		$developer = [$developer];
		$this->loadRelations($developer);

		return array_shift($developer);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		$developerList = $this->developerRepository->findAll($order, $filter);

		$this->loadRelations($developerList);

		return $developerList;
	}

	public function loadRelations(array &$developerList): void
	{

		$developerIdList = array_map(function(DeveloperEntity $developer) {
			return $developer->getId();
		}, $developerList);

		$buildObjectList = $this->buildObjectRepository->findAll();

		$developerList = array_map(function(DeveloperEntity $developer) use ($buildObjectList) {

			$currentBuildObject = array_filter($buildObjectList, function(BuildObjectEntity $buildObject) use ($developer) {
				return $buildObject->getDeveloperId() === $developer->getId();
			});

			if(count($currentBuildObject) > 0)
			{
				foreach($currentBuildObject as $buildObject)
				{
					$developer->addBuildObject($buildObject);
				}
			}

			return $developer;

		}, $developerList);


		$cityIdList = array_map(function(DeveloperEntity $developerEntity) {
			return $developerEntity->getCityId();
		}, $developerList);

		$cityList = $this->cityRepository->findAll(
			[],
			[
				CityTable::F_ID => $cityIdList,
			]
		);

		$developerList = array_map(function(DeveloperEntity $developer) use ($cityList) {

			$currentCity = array_filter($cityList, function(CityEntity $city) use ($developer) {
				return $city->getId() === $developer->getCityId();
			});

			if(count($currentCity) == 1)
			{
				$currentCity = array_shift($currentCity);
				$developer->addCity($currentCity);
			}

			return $developer;
		}, $developerList);


		$developerList = array_map(function(DeveloperEntity $developerEntity) {

			$image = $this->imageService->findById($developerEntity->getPictureId());
			if($image)
			{
				$developerEntity->addPicture(new ImageValueObject($image->id, $image->src));
			}

			return $developerEntity;
		}, $developerList);
	}
}