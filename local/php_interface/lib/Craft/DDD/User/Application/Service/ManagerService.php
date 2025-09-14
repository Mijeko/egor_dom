<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\Helper\Criteria;

class ManagerService
{
	public function __construct(
		protected ManagerRepositoryInterface $repository,
		protected ImageServiceInterface      $imageService,
	)
	{
	}

	public function findAll(Criteria $criteria = null): array
	{
		$managerList = $this->repository->findAll($criteria);

		return array_map(function($manager) {

			$this->hydrate($manager);

			return $manager;

		}, $managerList);
	}

	private function hydrate(ManagerEntity &$entity): void
	{
		$avatarImage = $this->imageService->findById($entity->getAvatarId());
		if($avatarImage)
		{
			$entity->setAvatar(new ImageValueObject(
				$avatarImage->id,
				$avatarImage->src,
			));
		}
	}
}