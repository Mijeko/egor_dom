<?php

namespace Craft\DDD\Developers\Application\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;

class DeveloperService
{
	public function __construct(
		protected DeveloperRepositoryInterface   $developerRepository,
		protected BuildObjectRepositoryInterface $buildObjectRepository,
	)
	{
	}

	public function findById(int $id): ?DeveloperEntity
	{
		return $this->developerRepository->findById($id);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		$developerList = $this->developerRepository->findAll($order, $filter);
		$idList = array_map(function(DeveloperEntity $developer) {
			return $developer->getId();
		}, $developerList);


		$buildObjectList = $this->buildObjectRepository->findAll(
			[],
			[
				BuildObjectTable::F_DEVELOPER_ID => $idList,
			]
		);


		$developerList = array_map(function(DeveloperEntity $developer) use ($buildObjectList) {

			$currentBuildObject = array_filter($buildObjectList, function(BuildObjectEntity $buildObject) use ($developer) {
				return $buildObject->getDeveloperId() === $developer->getId();
			});


			if(count($currentBuildObject) == 1)
			{
				$currentBuildObject = array_shift($currentBuildObject);
				$developer->addBuildObject($currentBuildObject);
			}

			return $developer;

		}, $developerList);

		return $developerList;
	}
}