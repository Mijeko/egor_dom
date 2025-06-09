<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Infrastructure\Entity\Developer as BxDeveloper;
use Craft\DDD\Developers\Domain\Entity\Developer;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;

class OrmDeveloperRepository implements DeveloperRepositoryInterface
{
	public function findAll(array $criteria = []): array
	{
		$result = [];
		$query = DeveloperTable::getList($criteria);

		foreach($query->fetchCollection() as $developer)
		{
			/**
			 * @var BxDeveloper $developer
			 */

			$result[] = new Developer(
				$developer->getId(),
				$developer->getName(),
			);
		}

		return $result;
	}
}