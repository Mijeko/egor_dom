<?php

namespace Craft\Phpunit\Fakes\Repository;

use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Referal\Infrastructure\Entity\ReferralTable;
use Craft\Helper\Criteria;

class ArrayReferralRepository implements ReferralRepositoryInterface
{
	private array $items = [];

	public function __construct() { }

	public function create(ReferralEntity $referral): ?ReferralEntity
	{
		$this->items[] = $referral;

		return $referral;
	}

	public function update(ReferralEntity $referral): ?ReferralEntity
	{
		return null;
	}

	public function findAll(?Criteria $criteria = null): array
	{
		return array_filter($this->items, function(ReferralEntity $referral) use ($criteria) {
			$filter = $criteria->getFilter();
			$skip = false;


			foreach($filter as $key => $value)
			{
				switch($key)
				{
					case ReferralTable::F_USER_ID:
						$skip = $referral->getUserId() !== $value;
						break;
					case ReferralTable::F_CODE:
						$skip = $referral->getCode() !== $value;
						break;
					case ReferralTable::F_ACTIVE:
						$skip = $referral->getActive()->getValue() !== $value;
						break;
					case ReferralTable::F_PHONE:
						$skip = $referral->getPhone()->getValue() !== $value;
						break;
				}
			}

			if(!$skip)
			{
				return $referral;
			}
		});
	}

	public function findByUserId(int $userId): ?ReferralEntity
	{
		$models = $this->findAll(Criteria::instance()->filter([
			ReferralTable::F_USER_ID => $userId,
		]));

		if(count($models) !== 1)
		{
			return null;
		}

		return array_shift($models);
	}

	public function findAllInvitedMembers(int $userId): array
	{
		return [];
	}

	public function findByCode(string $code): ?ReferralEntity
	{
		$models = $this->findAll(Criteria::instance()->filter([
			ReferralTable::F_CODE => $code,
		]));

		if(count($models) !== 1)
		{
			return null;
		}

		return array_shift($models);
	}
}