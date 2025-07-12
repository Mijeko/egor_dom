<?php

namespace Craft\DDD\Developers\Infrastructure\Repository;

use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Domain\ValueObject\AddressValueObject;
use Craft\DDD\Developers\Domain\ValueObject\ApartmentValueObject;
use Craft\DDD\Developers\Domain\ValueObject\CityValueObject;
use Craft\DDD\Developers\Domain\ValueObject\CountryValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DistrictValueObject;
use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;
use Craft\DDD\Developers\Domain\ValueObject\RegionValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LatitudeValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LongitudeValueObject;
use Craft\Dto\BxImageDto;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObject;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;

class OrmBuildObjectRepository implements BuildObjectRepositoryInterface
{
	public function create(BuildObjectEntity $buildObjectEntity): ?BuildObjectEntity
	{
		$model = BuildObjectTable::createObject();

		$gallery = array_map(function(?ImageValueObject $image) {
			if($image)
			{
				return ['ID' => $image->getId()];
			}

			return null;
		}, $buildObjectEntity->getGallery()->getImages() ?? []);

		$model->setGalleryEx($gallery);
		$model->setLocationEx($buildObjectEntity->getLocation());

		$model->setName($buildObjectEntity->getName());
		$model->setDeveloperId($buildObjectEntity->getDeveloper()->getId());
		$model->setFloors($buildObjectEntity->getFloors());
		$model->setType($buildObjectEntity->getType());
		$model->setCityId($buildObjectEntity->getCity()->getId());


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
		$model = BuildObjectTable::getList([
			'filter' => [
				BuildObjectTable::F_NAME => $name,
			],
		])->fetchObject();

		if(!$model)
		{
			return null;
		}

		return $this->hydrateElement($model);
	}

	public function findById(int $id): ?BuildObjectEntity
	{
		$model = BuildObjectTable::getByPrimary($id)->fetchObject();
		if(!$model)
		{
			return null;
		}

		return $this->hydrateElement($model);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		$result = [];
		$query = BuildObjectTable::getList([
			'order'  => $order,
			'filter' => $filter,
		]);

		foreach($query->fetchCollection() as $buildObject)
		{
			/* @var BuildObject $buildObject */
			$result[] = $this->hydrateElement($buildObject);
		}

		return $result;
	}

	protected function hydrateElement(BuildObject $buildObject): BuildObjectEntity
	{
		$location = $buildObject->getLocationEx();

		return new BuildObjectEntity(
			$buildObject->getId(),
			$buildObject->getName(),
			$buildObject->getType(),
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
			$buildObject->getDeveloperId(),
			null,
			null,
			ImageGalleryValueObject::fillFromId($buildObject->getGalleryEx()),
			null
		);
	}
}