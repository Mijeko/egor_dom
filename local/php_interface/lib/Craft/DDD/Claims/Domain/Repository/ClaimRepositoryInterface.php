<?php

namespace Craft\DDD\Claims\Domain\Repository;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\Helper\Criteria;

interface ClaimRepositoryInterface
{
	public function create(ClaimEntity $claim): ClaimEntity;

	public function update(ClaimEntity $claim): ?ClaimEntity;

	/**
	 * @param Criteria|null $criteria
	 * @return ClaimEntity[]
	 */
	public function findAll(Criteria $criteria = null): array;

	/**
	 * @param array $order
	 * @return ClaimEntity[]
	 */
	public function findAllByUserId(int $userId, array $order = []): array;

	public function findAllByManagerId(int $managerId): array;

	public function findById(int $claimId): ?ClaimEntity;
}