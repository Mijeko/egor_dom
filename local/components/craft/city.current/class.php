<?php

use Craft\DDD\City\Application\Dto\StoreCurrentCityDto;
use Craft\DDD\City\Application\Factory\StoreCurrentCityUseCaseFactory;
use Craft\DDD\City\Infrastructure\Service\CurrentCityService;
use Craft\DDD\City\Present\Dto\CityDto;
use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\City\Infrastructure\Entity\CityTable;
use Craft\DDD\City\Infrastructure\Factory\CurrentCityServiceFactory;
use Craft\DDD\City\Domain\Repository\CityRepositoryInterface;
use Craft\DDD\City\Infrastructure\Repository\OrmCityRepository;

class CraftCityCurrentComponent extends \Craft\Core\Component\AjaxComponent
{

	protected CityRepositoryInterface $cityRepository;
	protected CurrentCityService $currentCity;

	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function loadServices(): void
	{
		$this->cityRepository = new OrmCityRepository();
		$this->currentCity = CurrentCityServiceFactory::getService();
	}

	protected function loadData(): void
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

	function componentNamespace(): string
	{
		return 'craft.city';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$service = StoreCurrentCityUseCaseFactory::getService();
			$service->execute(new StoreCurrentCityDto(intval($formData['id'])));
			\Craft\Core\Rest\ResponseBx::success([
				'redirect' => '/',
			]);
		} catch(Exception $exception)
		{
			\Craft\Core\Rest\ResponseBx::badRequest($exception->getMessage());
		}
	}

	protected function modules(): ?array
	{
		return [];
	}
}