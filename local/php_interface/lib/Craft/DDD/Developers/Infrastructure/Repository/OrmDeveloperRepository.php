<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\ValueObject\ImportSettingValueObject;
use Craft\DDD\Developers\Infrastructure\Entity\Developer;
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
			$result[] = $this->hydrateElement($developer);
		}

		return $result;
	}

	public function findById(int $id): ?DeveloperEntity
	{
		$developers = $this->findAll(
			[],
			[
				DeveloperTable::F_ID => $id,
			],
		);

		if(count($developers) != 1)
		{
			return null;
		}

		return array_shift($developers);
	}

	protected function hydrateElement(Developer $developer): DeveloperEntity
	{
		return DeveloperEntity::hydrate(
		// @phpstan-ignore method.notFound
			$developer->getId(),
			// @phpstan-ignore method.notFound
			$developer->getName(),
			// @phpstan-ignore method.notFound
			$developer->getPictureId(),
			// @phpstan-ignore method.notFound
			$developer->getCityId(),
			null,
			new ImportSettingValueObject(
				$developer->importSettings()->getHandler(),
				$developer->importSettings()->getLinkSource(),
				null
			)
		);
	}
}