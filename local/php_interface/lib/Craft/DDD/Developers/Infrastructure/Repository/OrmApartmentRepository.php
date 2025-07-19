<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\ValueObject\BuiltStateValueObject;
use Craft\DDD\Developers\Domain\ValueObject\StringLogicValueObject;
use Craft\DDD\Developers\Infrastructure\Entity\Apartment;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;

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
		$model->setFloor($apartment->getFloor());
		$model->setRooms($apartment->getRooms());
		$model->setParking($apartment->getParking()->getBoolValue());
		$model->setBuiltYear($apartment->getBuiltYear());
		$model->setBuildingState($apartment->getBuildingState()->getValue());
		$model->setMortgage($apartment->getMortgage());
		$model->setBathroomUnit($apartment->getBathroomUnit()->getValue());
		$model->setRenovation($apartment->getRenovation());
		$model->setAreaEx($apartment->getArea());
		$model->setPlanImageEx($apartment->getPlanImages());

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
		$buildObject = null;
		return new ApartmentEntity(
			$apartment->getId(),
			$apartment->getBuildObjectId(),
			$buildObject,
			$apartment->getName(),
			$apartment->getDescription(),
			$apartment->getPrice(),
			$apartment->getRooms(),
			$apartment->getFloor(),
			null,
			$apartment->getRenovation(),
			new StringLogicValueObject($apartment->getParking()),
			new StringLogicValueObject($apartment->getBathroomUnit()),
			$apartment->getMortgage(),
			$apartment->getBuiltYear(),
			new BuiltStateValueObject($apartment->getBuildingState()),
			ImageGalleryValueObject::fillFromId($apartment->getPlanImageEx()),
			ImageGalleryValueObject::fillFromId($apartment->getGalleryEx()),
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