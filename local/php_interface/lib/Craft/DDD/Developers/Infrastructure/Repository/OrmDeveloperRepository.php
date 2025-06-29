<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Infrastructure\Entity\Developer as BxDeveloper;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;

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
			/**
			 * @var BxDeveloper $developer
			 */

			$result[] = new DeveloperEntity(
				$developer->getId(),
				$developer->getName(),
				$developer->getPictureId(),
			);
		}

		return $result;
	}

	public function findById(int $id): ?DeveloperEntity
	{
		return null;
	}
}