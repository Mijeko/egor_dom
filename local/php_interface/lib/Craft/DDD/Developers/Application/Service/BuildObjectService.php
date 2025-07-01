<?php

namespace Craft\DDD\Developers\Application\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;

class BuildObjectService
{
	public function __construct(
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected DeveloperService               $developerService,
	)
	{
	}

	public function create(BuildObjectEntity $developer): ?BuildObjectEntity
	{
		return null;
	}

	public function findById(int $id): ?BuildObjectEntity
	{
		return $this->buildObjectRepository->findById($id);
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