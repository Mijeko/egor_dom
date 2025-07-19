<?php

namespace Craft\DDD\Developers\Application\Service;

use Craft\DDD\Developers\Application\Dto\ApartmentFilterDto;
use Craft\DDD\Developers\Application\Dto\ApartmentPreFilterDto;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;

class BuildApartmentFilter
{
	public static function execute(ApartmentPreFilterDto|ApartmentFilterDto $filterBody): array
	{
		$filter = [];


		if($filterBody->floorsTotal)
		{
			//			$filter[ApartmentTable::F_FLOOR] = $filterBody->floorsTotal;
		}

		if($filterBody->floor)
		{
			$filter[ApartmentTable::F_FLOOR] = $filterBody->floor;
		}

		if($filterBody->roomsTotal)
		{
			$filter[ApartmentTable::F_ROOMS] = $filterBody->roomsTotal;
		}

		if($filterBody->renovation)
		{
			$filter[ApartmentTable::F_RENOVATION] = $filterBody->renovation;
		}

		if($filterBody->bathroom)
		{
			$filter[ApartmentTable::F_BATHROOM_UNIT] = $filterBody->bathroom;
		}

		return $filter;
	}
}