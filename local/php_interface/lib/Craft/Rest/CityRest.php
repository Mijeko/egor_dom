<?php

namespace Craft\Rest;

use Craft\DDD\City\Application\Dto\StoreCurrentCityDto;
use Craft\DDD\City\Application\Factory\StoreCurrentCityUseCaseFactory;

class CityRest extends \IRestService
{
	public static function storeCurrentCity($query, $nav, \CRestServer $server): array
	{

		try
		{
			$service = StoreCurrentCityUseCaseFactory::getService();
			$service->execute(new StoreCurrentCityDto(intval($query['id'])));

			return [
				'success' => true,
			];
		} catch(\Exception $e)
		{
			return [
				'success' => false,
				'error'   => $e->getMessage(),
			];
		}
	}
}