<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\Developers\Domain\ValueObject\AddressValueObject;
use Craft\DDD\Developers\Domain\ValueObject\ApartmentValueObject;
use Craft\DDD\Developers\Domain\ValueObject\CityValueObject;
use Craft\DDD\Developers\Domain\ValueObject\CountryValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DistrictValueObject;
use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;
use Craft\DDD\Developers\Domain\ValueObject\RegionValueObject;
use Craft\DDD\Developers\Infrastructure\Entity\EO_BuildObject;
use Craft\DDD\Shared\Domain\ValueObject\LatitudeValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LongitudeValueObject;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObject;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\Helper\Criteria;

class OrmBuildObjectRepository implements BuildObjectRepositoryInterface
{
	public function update(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity
	{
		$model = BuildObjectTable::getByPrimary($buildObjectEntity->getId())->fetchObject();

		$this->fillModel($model, $buildObjectEntity);

		$result = $model->save();
		if($result->isSuccess())
		{
			return $buildObjectEntity;
		}

		return null;
	}

	public function create(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity
	{
		$model = BuildObjectTable::createObject();

		$this->fillModel($model, $buildObjectEntity);

		$result = $model->save();

		if($result->isSuccess())
		{
			$buildObjectEntity->refreshId($model->getId());
			return $buildObjectEntity;
		}

		throw new \Exception(implode("\n", $result->getErrorMessages()));
	}

	public function findByName(string $name): ?BuildObjectEntity
	{
		$buildObjectList = $this->findAll(
			Criteria::instance()->filter([
				BuildObjectTable::F_NAME => $name,
			])
		);

		if(count($buildObjectList) != 1)
		{
			return null;
		}

		return array_shift($buildObjectList);
	}

	public function findById(int $id): ?BuildObjectEntity
	{
		$buildObjectList = $this->findAll(
			Criteria::instance()->filter([
				BuildObjectTable::F_ID => $id,
			])
		);

		if(count($buildObjectList) != 1)
		{
			return null;
		}

		return array_shift($buildObjectList);
	}

	/**
	 * @param Criteria|null $criteria
	 * @return BuildObjectEntity[]
	 */
	public function findAll(Criteria $criteria = null): array
	{
		$result = [];
		$params = [];
		if($criteria)
		{
			$params = $criteria->cache(['ttl' => 3600 * 48])->makeGetListParams();
		}
		$query = BuildObjectTable::getList($params);

		foreach($query->fetchCollection() as $buildObject)
		{
			/* @var BuildObject $buildObject */
			$result[] = $this->hydrateElement($buildObject);
		}

		return $result;
	}

	private function fillModel(EO_BuildObject &$model, BuildObjectEntity $buildObjectEntity): void
	{
		$model->setGalleryEx($buildObjectEntity->getGalleryIdList());
		$model->setLocationEx($buildObjectEntity->getLocation());
		$model->setName($buildObjectEntity->getName());
		$model->setDeveloperId($buildObjectEntity->getDeveloper()->getId());
		$model->setFloors($buildObjectEntity->getFloors());
		$model->setType($buildObjectEntity->getType());
		$model->setCityId($buildObjectEntity->getCity()->getId());
	}

	protected function hydrateElement(BuildObject $buildObject): BuildObjectEntity
	{
		$location = $buildObject->getLocationEx();

		return BuildObjectEntity::hydrate(
		// @phpstan-ignore method.notFound
			$buildObject->getId(),
			// @phpstan-ignore method.notFound
			$buildObject->getName(),
			// @phpstan-ignore method.notFound
			$buildObject->getType(),
			// @phpstan-ignore method.notFound
			$buildObject->getFloors(),
			new LocationValueObject(
				new CountryValueObject($location['country']),
				new RegionValueObject($location['region']),
				new DistrictValueObject($location['district']),
				new CityValueObject($location['city']),
				new AddressValueObject($location['address']),
				new ApartmentValueObject($location['apartment']),
				new LongitudeValueObject($location['longitude']),
				new LatitudeValueObject($location['latitude']),
			),
			$buildObject->getGalleryEx(),
			// @phpstan-ignore method.notFound
			$buildObject->getDeveloperId(),
		);
	}
}