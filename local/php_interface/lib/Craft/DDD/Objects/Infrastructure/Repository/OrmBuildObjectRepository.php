<?php

namespace Craft\DDD\Objects\Infrastructure\Repository;

use Craft\DDD\Objects\Domain\Entity\BuildObject;
use Craft\DDD\Objects\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Objects\Infrastructure\Entity\BuildObjectTable;

class OrmBuildObjectRepository implements BuildObjectRepositoryInterface
{


	public function findById(int $id): ?BuildObject
	{
		$model = BuildObjectTable::getByPrimary($id)->fetchObject();
		if(!$model)
		{
			return null;
		}


		return new BuildObject(
			$model->getId(),
			$model->getName(),
			$model->getPictureId(),
		);
	}

	public function findAll(array $criteria = []): array
	{
		$result = [];
		$query = BuildObjectTable::getList($criteria);

		foreach($query->fetchCollection() as $buildObject)
		{

			/* @var \Craft\DDD\Objects\Infrastructure\Entity\BuildObject $buildObject */

			$result[] = new BuildObject(
				$buildObject->getId(),
				$buildObject->getName(),
				$buildObject->getPictureId()
			);
		}

		return $result;
	}
}