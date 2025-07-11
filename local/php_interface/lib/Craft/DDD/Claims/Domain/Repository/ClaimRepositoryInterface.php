<?php

namespace Craft\DDD\Claims\Domain\Repository;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;

interface ClaimRepositoryInterface
{
	public function create(ClaimEntity $claim): ?ClaimEntity;

	/**
	 * @return ClaimEntity[]
	 */
	public function findAll(): array;


	/**
	 * @return ClaimEntity[]
	 */
	public function findAllByUserId(int $userId): array;

	public function findById(int $claimId): ?ClaimEntity;
}