<?php

namespace Craft\DDD\City\Infrastructure\Repository;

use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\City\Domain\Repository\CityRepositoryInterface;
use Craft\DDD\City\Infrastructure\Entity\City;
use Craft\DDD\City\Infrastructure\Entity\CityTable;
use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;
use Craft\DDD\Shared\Domain\ValueObject\SortValueObject;
use Craft\DDD\Shared\Infrastructure\Exceptions\NotFoundOrmElement;

class OrmCityRepository implements CityRepositoryInterface
{

	public function create(CityEntity $city): ?CityEntity
	{
		return null;
	}

	public function findById(int $id): ?CityEntity
	{
		$model = CityTable::getByPrimary($id)->fetchObject();
		if(!$model)
		{
			throw new NotFoundOrmElement('Город не найден в базе данных');
		}

		return $this->hydrate($model);
	}

	public function findAll(array $order = [], array $filter = []): array
	{
		$result = [];
		$query = CityTable::getList([
			'order'  => $order,
			'filter' => $filter,
		])->fetchCollection();

		foreach($query as $city)
		{
			$result[] = $this->hydrate($city);
		}

		return $result;
	}

	protected function hydrate(City $city): CityEntity
	{
		return new CityEntity(
			$city->getId(),
			$city->getName(),
			$city->getCode(),
			new ActiveValueObject($city->getActive()),
			new SortValueObject($city->getSort()),
		);
	}
}