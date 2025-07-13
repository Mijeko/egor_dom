<?php

namespace Craft\DDD\Claims\Domain\Repository;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;

interface ClaimRepositoryInterface
{
	public function create(ClaimEntity $claim): ClaimEntity;

	/**
	 * @return ClaimEntity[]
	 */
	public function findAll(array $order = [], array $filter = []): array;


	/**
	 * @param array $order
	 * @return ClaimEntity[]
	 */
	public function findAllByUserId(int $userId, array $order = []): array;

	public function findById(int $claimId): ?ClaimEntity;
}