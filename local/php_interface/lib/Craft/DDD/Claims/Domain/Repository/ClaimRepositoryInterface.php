<?php

namespace Craft\DDD\Claims\Domain\Repository;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;

interface ClaimRepositoryInterface
{
	public function create(ClaimEntity $claim): ?ClaimEntity;

	/**
	 * @return ClaimEntity[]
	 */
	public function getAll(): array;


	/**
	 * @return ClaimEntity[]
	 */
	public function getAllByUserId(int $userId): array;
}