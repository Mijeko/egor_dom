<?php

namespace Craft\DDD\Claims\Application\Services;

use Craft\DDD\Claims\Domain\Entity\Claim;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;

class ClaimService
{

	public function __construct(
		protected ClaimRepositoryInterface $repository,
	)
	{
	}


	/**
	 * @return Claim[]
	 */
	public function getAllClaim(): array
	{
		return $this->repository->getAll();
	}

	/**
	 * @return Claim[]
	 */
	public function getAllByUserId(int $userId): array
	{
		return $this->repository->getAllByUserId($userId);
	}
}
