<?php

namespace Craft\DDD\Objects\Infrastructure\Repository;

use Craft\DDD\Objects\Domain\Entity\BuildObject;
use Craft\DDD\Objects\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Objects\Infrastructure\Entity\BuildObjectTable;
use Craft\Dto\BxImage;

class OrmBuildObjectRepository implements BuildObjectRepositoryInterface
{


	public function findById(int $id): ?BuildObject
	{
		$model = BuildObjectTable::getByPrimary($id)->fetchObject();
		if(!$model)
		{
			return null;
		}

		return $this->mapElement($model);
	}

	public function findAll(array $criteria = []): array
	{
		$result = [];
		$query = BuildObjectTable::getList($criteria);

		foreach($query->fetchCollection() as $buildObject)
		{
			/* @var \Craft\DDD\Objects\Infrastructure\Entity\BuildObject $buildObject */
			$result[] = $this->mapElement($buildObject);
		}

		return $result;
	}

	protected function mapElement(\Craft\DDD\Objects\Infrastructure\Entity\BuildObject $buildObject): BuildObject
	{
		$_picture = \CFile::GetFileArray($buildObject->getPictureId());
		$picture = null;
		if($_picture)
		{
			$picture = new BxImage(
				$_picture['ID'],
				$_picture['SRC'],
			);
		}

		return new BuildObject(
			$buildObject->getId(),
			$buildObject->getName(),
			$picture
		);
	}
}