<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\ValueObject\Developer\DescriptionValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Developers\Infrastructure\Entity\EO_Developer;
use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;

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

	protected function hydrateElement(EO_Developer $developer): DeveloperEntity
	{
		return DeveloperEntity::hydrate(
		// @phpstan-ignore method.notFound
			$developer->getId(),
			// @phpstan-ignore method.notFound
			$developer->getName(),
			new DescriptionValueObject($developer->getDescription()),
			// @phpstan-ignore method.notFound
			$developer->getSort(),
			new ActiveValueObject($developer->getActive()),
			// @phpstan-ignore method.notFound
			$developer->getPictureId(),
			// @phpstan-ignore method.notFound
			$developer->getCityId(),
			DeveloperSettingsValueObject::fromJson($developer->getSettings()),
		);
	}

	public function update(DeveloperEntity $developer): ?DeveloperEntity
	{
		$model = DeveloperTable::getByPrimary($developer->getId())->fetchObject();

		$this->fill($model, $developer);

		$result = $model->save();

		if(!$result->isSuccess())
		{
			throw new \Exception(implode("\n", $result->getErrorMessages()));
		}

		return $developer;
	}

	protected function fill(Eo_Developer &$developer, DeveloperEntity $entity): void
	{
		$developer->setName($entity->getName());
		$developer->setDescription($entity->getDescription()->getValue());
		$developer->setActive($entity->getActive()->getValue());
		$developer->setSort($entity->getSort());
		$developer->setPictureId($entity->getPictureId());
		$developer->setCityId($entity->getCityId());
		$developer->setSettings($entity->getSettings()->toJson());
	}
}