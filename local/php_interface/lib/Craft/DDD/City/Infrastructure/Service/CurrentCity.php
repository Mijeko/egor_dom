<?php

namespace Craft\DDD\City\Infrastructure\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\City\Domain\Repository\CityRepositoryInterface;
use Craft\DDD\City\Infrastructure\Interfaces\City\CurrentCityStorageInterface;

class CurrentCity
{

	public function __construct(
		protected CityRepositoryInterface     $repository,
		protected CurrentCityStorageInterface $storage,
	)
	{
	}

	public function save(CityEntity $city): CityEntity
	{
		$this->storage->store($city);


		if(!$this->storage->has())
		{
			throw new \Exception('Город не сохранился в хранилище');
		}

		return $city;
	}

	public function current(): ?CityEntity
	{
		try
		{
			if(!$this->has())
			{
				$this->setDefault();
			}

			$currentCityId = $this->storage->get();

			$current = $this->repository->findById($currentCityId);

			if(!$current)
			{
				throw new \Exception("Такого города не существует");
			}

			return $current;
		} catch(\Exception $e)
		{
			Debug::dumpToFile($e->getMessage(), '', '__critError.log');
		}

		return null;
	}

	public function has(): bool
	{
		return $this->storage->has();
	}

	public function setDefault(): void
	{
		$default = $this->repository->findDefault();
		if(!$default)
		{
			throw new \Exception('Не могу иницилизировать город по умолчанию');
		}

		$this->storage->store($default);
	}
}