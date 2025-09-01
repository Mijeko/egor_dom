<?php

namespace Craft\DDD\Referal\Domain\Repository;

use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\Helper\Criteria;

interface ReferralRepositoryInterface
{
	public function create(ReferralEntity $referral): ?ReferralEntity;

	public function findAll(Criteria $criteria): array;

	public function findByUserId(int $userId): ?ReferralEntity;

	public function findAllInvitedMembers(int $userId): array;

	public function findByCode(string $code): ?ReferralEntity;
}