<?php

use Craft\DDD\City\Infrastructure\Service\CurrentCityService;
use Craft\DDD\City\Present\Dto\CityDto;
use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\City\Infrastructure\Entity\CityTable;
use Craft\DDD\City\Infrastructure\Factory\CurrentCityFactory;
use Craft\DDD\City\Domain\Repository\CityRepositoryInterface;
use Craft\DDD\City\Infrastructure\Repository\OrmCityRepository;

class CraftCityCurrentComponent extends CBitrixComponent
{

	protected CityRepositoryInterface $cityRepository;
	protected CurrentCityService $currentCity;

	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{
			$this->loadServices();
			$this->loadData();

			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
		}
	}

	private function loadServices(): void
	{
		$this->cityRepository = new OrmCityRepository();
		$this->currentCity = CurrentCityFactory::getService();
	}

	private function loadData(): void
	{

		$this->arResult['CURRENT'] = CityDto::fromEntity($this->currentCity->current());

		$this->arResult['CITY_LIST'] = array_map(
			function(CityEntity $item) {
				return CityDto::fromEntity($item);
			},
			$this->cityRepository->findAll(
				[],
				[
					CityTable::F_ACTIVE => CityTable::ACTIVE_Y,
				]
			)
		);
	}
}