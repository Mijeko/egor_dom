<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\ValueObject\BuiltStateValueObject;
use Craft\DDD\Developers\Domain\ValueObject\StringLogicValueObject;
use Craft\DDD\Developers\Infrastructure\Entity\Apartment;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\Helper\Criteria;

class OrmApartmentRepository implements ApartmentRepositoryInterface
{

	/**
	 * @param Criteria|null $criteria
	 * @return ApartmentEntity[]
	 */
	public function findAll(Criteria $criteria = null): array
	{
		$result = [];
		$apartmentList = ApartmentTable::getList($criteria->cache(['ttl' => 3600 * 48])->makeGetListParams())
			->fetchCollection();

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
		$model->setFloor($apartment->getFloor());
		$model->setRooms($apartment->getRooms());
		$model->setParking($apartment->getParking()->getBoolValue());
		$model->setBuiltYear($apartment->getBuiltYear());
		$model->setBuildingState($apartment->getBuildingState()->getValue());
		$model->setMortgage($apartment->getMortgage());
		$model->setBathroomUnit($apartment->getBathroomUnit()->getValue());
		$model->setRenovation($apartment->getRenovation());
		$model->setArea($apartment->getArea()->toJson());
		$model->setPlanImageEx($apartment->getPlanImagesIdList());
		$model->setExternalId($apartment->getExternalId());

		$result = $model->save();

		if(!$result->isSuccess())
		{
			throw new \RuntimeException('Ошибка создания квартиры: ' . implode('\n', $result->getErrorMessages()));
		}

		$apartment->refreshId($model->getId());

		return $apartment;
	}

	public function update(ApartmentEntity $apartment): ApartmentEntity
	{
		return $apartment;
	}

	protected function hydrateElement(Apartment $apartment): ApartmentEntity
	{
		return ApartmentEntity::hydrate(
			$apartment->getId(),
			$apartment->getBuildObjectId(),
			$apartment->getName(),
			$apartment->getDescription(),
			$apartment->getPrice(),
			$apartment->getRooms(),
			$apartment->getFloor(),
			null,
			$apartment->getRenovation(),
			new  StringLogicValueObject($apartment->getParking()),
			new  StringLogicValueObject($apartment->getBathroomUnit()),
			$apartment->getMortgage(),
			$apartment->getBuiltYear(),
			$apartment->getPlanImageEx(),
			new BuiltStateValueObject($apartment->getBuildingState()),
			$apartment->getExternalId(),
		);
	}

	public function findById(int $id): ?ApartmentEntity
	{
		$apartmentList = $this->findAll(Criteria::instance(
			[],
			[
				ApartmentTable::F_ID => $id,
			]
		));

		if(count($apartmentList) != 1)
		{
			return null;
		}

		return array_shift($apartmentList);
	}

	public function findByExternalId(string $externalId): ?ApartmentEntity
	{
		$apartmentList = $this->findAll(Criteria::instance(
			[],
			[
				ApartmentTable::F_EXTERNAL_ID => $externalId,
			]
		));

		if(count($apartmentList) != 1)
		{
			return null;
		}

		return array_shift($apartmentList);
	}

	public function countByBuildObjectId(int $buildObjectId): int
	{
		return ApartmentTable::getList([
			'filter' => [
				ApartmentTable::F_ACTIVE          => ApartmentTable::ACTIVE_Y,
				ApartmentTable::F_BUILD_OBJECT_ID => $buildObjectId,
			],
		])->getSelectedRowsCount();
	}
}