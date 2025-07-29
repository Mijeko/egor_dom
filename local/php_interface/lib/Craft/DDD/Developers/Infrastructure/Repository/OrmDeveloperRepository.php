<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\ValueObject\ImportSettingValueObject;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObject;
use Craft\DDD\Developers\Infrastructure\Entity\Developer;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Infrastructure\Dto\ResultImageSaveDto;
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
		return new DeveloperEntity(
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