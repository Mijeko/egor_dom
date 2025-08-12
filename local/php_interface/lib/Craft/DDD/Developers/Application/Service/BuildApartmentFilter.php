<?php

namespace Craft\DDD\Developers\Application\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Application\Dto\ApartmentFilterDto;
use Craft\DDD\Developers\Application\Dto\ApartmentPreFilterDto;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;

class BuildApartmentFilter
{
	public static function execute(ApartmentPreFilterDto|ApartmentFilterDto $filterBody): array
	{
		$filter = [];

		if($filterBody->developerId)
		{
			$filter[ApartmentTable::R_BUILD_OBJECT . '.' . BuildObjectTable::F_DEVELOPER_ID] = $filterBody->developerId;
		}

		if($filterBody->buildObjectId)
		{
			$filter[ApartmentTable::F_BUILD_OBJECT_ID] = $filterBody->buildObjectId;
		}

		if($filterBody->floorsTotal)
		{
			$filter[ApartmentTable::R_BUILD_OBJECT . '.' . BuildObjectTable::F_FLOORS] = $filterBody->floorsTotal;
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

		Debug::dumpToFile($filter);

		return $filter;
	}
}