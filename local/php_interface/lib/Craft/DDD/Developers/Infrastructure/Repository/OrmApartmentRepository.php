<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\Apartment;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;

class OrmApartmentRepository implements ApartmentRepositoryInterface
{

	public function findAll(array $order = [], array $filter = []): array
	{
		$result = [];
		$apartmentList = ApartmentTable::getList([
			'order'  => $order,
			'filter' => $filter,
		])->fetchCollection();

		foreach($apartmentList as $apartment)
		{
			$result[] = $this->hydrateElement($apartment);
		}

		return $result;
	}

	public function create(ApartmentEntity $apartment): ApartmentEntity
	{

		$model = ApartmentTable::createObject();

		$model->setName($apartment->getName());
		$model->setCode(md5(rand()));
		$model->setBuildObjectId($apartment->getBuildObject()->getId());
		$model->setPrice($apartment->getPrice());

		$result = $model->save();

		if(!$result->isSuccess())
		{
			throw new \RuntimeException('Ошибка создания квартиры: ' . implode('\n', $result->getErrorMessages()));
		}

		$apartment->refreshId($model->getId());

		return $apartment;
	}

	protected function hydrateElement(Apartment $apartment): ApartmentEntity
	{
		return new ApartmentEntity(
			$apartment->getId(),
			null,
			null,
			$apartment->getName(),
			null,
			$apartment->getPrice(),
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
		);
	}
}