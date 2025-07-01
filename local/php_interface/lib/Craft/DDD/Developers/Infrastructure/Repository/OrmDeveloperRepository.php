<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Infrastructure\Entity\Developer;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\Dto\BxImageDto;

class OrmDeveloperRepository implements DeveloperRepositoryInterface
{
	public function findAll(array $order = [], array $filter = []): array
	{
		$result = [];
		$query = DeveloperTable::getList([
			'order'  => $order,
			'filter' => $filter,
		]);

		foreach($query->fetchCollection() as $developer)
		{
			$result[] = $this->hydrateElement($developer);
		}

		return $result;
	}

	public function findById(int $id): ?DeveloperEntity
	{
		$result = DeveloperTable::getById($id)->fetchObject();

		return $this->hydrateElement($result);
	}

	protected function hydrateElement(Developer $developer): DeveloperEntity
	{
		$image = null;
		$_image = \CFile::GetFileArray($developer->getPictureId());
		if($_image)
		{
			$image = new BxImageDto($_image['ID'], $_image['SRC']);
		}


		return new DeveloperEntity(
			$developer->getId(),
			$developer->getName(),
			$image,
			null,
		);
	}
}