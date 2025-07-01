<?php

namespace Craft\DDD\Developers\Application;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;

class ApartmentService
{

	public function __construct(
		protected ApartmentRepositoryInterface $apartmentRepository,
	)
	{
	}

	public function create(ApartmentEntity $apartment): ApartmentEntity
	{
		return $this->apartmentRepository->create($apartment);
	}
}