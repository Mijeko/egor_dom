<?php

namespace Craft\DDD\Developers\Application\Service;

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

	public function findAll(array $order = [], array $filters = []): array
	{
		return $this->apartmentRepository->findAll($filters, $order);
	}

	public function create(ApartmentEntity $apartment): ApartmentEntity
	{

		if($buildObjectEntity = $apartment->getBuildObject())
		{
			$_buildObject = $this->buildObjectService->findByName($buildObjectEntity->getName());

			if(!$_buildObject)
			{
				$_buildObject = $this->buildObjectService->create($buildObjectEntity);
				if(!$_buildObject)
				{
					throw new \RuntimeException("Ошибка создания объекта недвижимости");
				}
			}

			$apartment->getBuildObject()->refreshId($_buildObject->getId());
		}

		return $this->apartmentRepository->create($apartment);
	}
}