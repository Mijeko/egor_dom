<?php

namespace Craft\DDD\Claims\Domain\Repository;

use Craft\DDD\Claims\Domain\Entity\Claim;

interface ClaimRepositoryInterface
{
	public function create(Claim $claim): ?Claim;

	/**
	 * @return Claim[]
	 */
	public function getAll(): array;


	/**
	 * @return Claim[]
	 */
	public function getAllByUserId(int $userId): array;
}