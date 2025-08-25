<?php

namespace Craft\DDD\Referal\Infrastructure\Repository;

use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\Helper\Criteria;

class ReferralRepository implements ReferralRepositoryInterface
{
	public function create(ReferralEntity $referral): ?ReferralEntity
	{
		return null;
	}

	public function findAll(Criteria $criteria): array
	{
		return [];
	}

	public function findByUserId(int $userId): ?ReferralEntity
	{
		return null;
	}

	public function findByCode(string $code): ?ReferralEntity
	{
		return null;
	}
}