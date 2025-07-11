<?php

namespace Craft\DDD\Claims\Application\Services;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;

class ClaimService
{

	public function __construct(
		protected ClaimRepositoryInterface $repository,
	)
	{
	}


	/**
	 * @return ClaimEntity[]
	 */
	public function getAllClaim(): array
	{
		return $this->repository->findAll();
	}

	/**
	 * @return ClaimEntity[]
	 */
	public function getAllByUserId(int $userId): array
	{
		return $this->repository->findAllByUserId($userId);
	}

	public function create(ClaimEntity $claim): ?ClaimEntity
	{
		return $this->repository->create($claim);
	}
}
