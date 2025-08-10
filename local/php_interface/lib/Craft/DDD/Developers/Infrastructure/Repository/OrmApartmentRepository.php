<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\ValueObject\BuiltStateValueObject;
use Craft\DDD\Developers\Domain\ValueObject\StringLogicValueObject;
use Craft\DDD\Developers\Infrastructure\Entity\Apartment;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;

class OrmApartmentRepository implements ApartmentRepositoryInterface
{

	/**
	 * @return ApartmentEntity[]
	 */
	public function findAll(array $order = [], array $filter = []): array
	{
		$result = [];
		$apartmentList = ApartmentTable::getList([
			'order'  => $order,
			'filter' => $filter,
			'cache'  => ['ttl' => 3600 * 48],
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
		$model->setFloor($apartment->getFloor());
		$model->setRooms($apartment->getRooms());
		$model->setParking($apartment->getParking()->getBoolValue());
		$model->setBuiltYear($apartment->getBuiltYear());
		$model->setBuildingState($apartment->getBuildingState()->getValue());
		$model->setMortgage($apartment->getMortgage());
		$model->setBathroomUnit($apartment->getBathroomUnit()->getValue());
		$model->setRenovation($apartment->getRenovation());
		$model->setArea($apartment->getArea()->toJson());
		$model->setPlanImageEx($apartment->getPlanImages());
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
		$buildObject = null;
		return new ApartmentEntity(
		// @phpstan-ignore method.notFound
			$apartment->getId(),
			// @phpstan-ignore method.notFound
			$apartment->getBuildObjectId(),
			// @phpstan-ignore method.notFound
			$buildObject,
			// @phpstan-ignore method.notFound
			$apartment->getName(),
			// @phpstan-ignore method.notFound
			$apartment->getDescription(),
			// @phpstan-ignore method.notFound
			$apartment->getPrice(),
			// @phpstan-ignore method.notFound
			$apartment->getRooms(),
			// @phpstan-ignore method.notFound
			$apartment->getFloor(),
			null,
			// @phpstan-ignore method.notFound
			$apartment->getRenovation(),
			new StringLogicValueObject(
			// @phpstan-ignore method.notFound
				$apartment->getParking()
			),
			new StringLogicValueObject(
			// @phpstan-ignore method.notFound
				$apartment->getBathroomUnit()
			),
			// @phpstan-ignore method.notFound
			$apartment->getMortgage(),
			// @phpstan-ignore method.notFound
			$apartment->getBuiltYear(),
			$apartment->getPlanImageEx(),
			$apartment->getGalleryEx(),
			new BuiltStateValueObject(
			// @phpstan-ignore method.notFound
				$apartment->getBuildingState()
			),
			// @phpstan-ignore method.notFound
			$apartment->getExternalId(),
		);
	}

	public function findById(int $id): ?ApartmentEntity
	{
		$model = ApartmentTable::getByPrimary($id)->fetchObject();
		if(!$model)
		{
			throw new \Exception('Квартира не найдена');
		}


		return $this->hydrateElement($model);
	}
}