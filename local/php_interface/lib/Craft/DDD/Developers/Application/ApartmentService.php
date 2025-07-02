<?php

namespace Craft\DDD\Developers\Application;

use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;

class ApartmentService
{

	public function __construct(
		protected ApartmentRepositoryInterface $apartmentRepository,
		protected BuildObjectService           $buildObjectService,
	)
	{
	}

	public function create(ApartmentEntity $apartment): ApartmentEntity
	{

		if($buildObjectEntity = $apartment->getBuildObject())
		{
			if(!$this->buildObjectService->create($buildObjectEntity))
			{
				throw new \RuntimeException("Ошибка создания объекта недвижимости");
			}
		}

		return $this->apartmentRepository->create($apartment);
	}
}