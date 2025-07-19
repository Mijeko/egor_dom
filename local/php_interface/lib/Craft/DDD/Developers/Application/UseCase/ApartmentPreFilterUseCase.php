<?php

namespace Craft\DDD\Developers\Application\UseCase;

use Craft\DDD\Developers\Application\Dto\ApartmentPreFilterDto;
use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Application\Service\BuildApartmentFilter;

class ApartmentPreFilterUseCase
{
	public function __construct(
		protected ApartmentService $apartmentService
	)
	{
	}

	public function execute(ApartmentPreFilterDto $filterBody): int
	{
		$apartments = $this->apartmentService->findAll(
			[],
			BuildApartmentFilter::execute($filterBody),
		);

		return count($apartments);
	}
}