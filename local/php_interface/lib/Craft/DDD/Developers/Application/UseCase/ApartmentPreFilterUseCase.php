<?php

namespace Craft\DDD\Developers\Application\UseCase;

use Craft\DDD\Developers\Application\Dto\ApartmentPreFilterDto;
use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;

class ApartmentPreFilterUseCase
{
	public function __construct(
		protected ApartmentService $apartmentService
	)
	{
	}

	public function execute(ApartmentPreFilterDto $filterBody): int
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

		$apartments = $this->apartmentService->findAll(
			[],
			$filter,
		);

		return count($apartments);
	}
}