<?php

namespace Craft\DDD\Developers\Application\UseCase;

use Craft\DDD\Developers\Application\Dto\ApartmentFilterDto;
use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Application\Service\BuildApartmentFilter;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Present\Dto\ApartmentDto;

class ApartmentFilterUseCase
{

	public function __construct(
		protected ApartmentService $service,
	)
	{
	}

	public function execute(ApartmentFilterDto $apartmentFilterDto): array
	{
		return array_map(
			function(ApartmentEntity $apartmentEntity) {
				return ApartmentDto::fromEntity($apartmentEntity);
			},
			$this->service->findAll(
				[],
				BuildApartmentFilter::execute($apartmentFilterDto)
			)
		);
	}
}