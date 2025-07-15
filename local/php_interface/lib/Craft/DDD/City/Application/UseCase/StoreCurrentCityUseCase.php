<?php

namespace Craft\DDD\City\Application\UseCase;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\City\Application\Dto\StoreCurrentCityDto;
use Craft\DDD\City\Domain\Repository\CityRepositoryInterface;
use Craft\DDD\City\Infrastructure\Service\CurrentCityService;

class StoreCurrentCityUseCase
{

	public function __construct(
		protected CityRepositoryInterface $cityRepository,
		protected CurrentCityService      $currentCityService,
	)
	{
	}

	public function execute(StoreCurrentCityDto $request): void
	{
		$city = $this->cityRepository->findById($request->id);
		if(!$city)
		{
			throw new \Exception('Город не найден');
		}

		session_start();
		Debug::dumpToFile($this->currentCityService->current());
		$this->currentCityService->save($city);
		Debug::dumpToFile($this->currentCityService->current());
	}
}