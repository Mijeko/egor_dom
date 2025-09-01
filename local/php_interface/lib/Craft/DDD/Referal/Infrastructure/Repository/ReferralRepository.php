<?php

namespace Craft\DDD\Referal\Infrastructure\Repository;

use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Referal\Infrastructure\Entity\EO_Referral;
use Craft\DDD\Referal\Infrastructure\Entity\ReferralTable;
use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\Helper\Criteria;

class ReferralRepository implements ReferralRepositoryInterface
{
	public function create(ReferralEntity $referral): ?ReferralEntity
	{
		$modal = ReferralTable::createObject();

		$modal->setCode($referral->getCode());
		$modal->setPhone($referral->getPhone()->getValue());
		$modal->setActive($referral->getActive()->getValue());
		$modal->setInvitedUserId($referral->getInviteUserId());
		$modal->setUserId($referral->getUserId());

		$result = $modal->save();

		if($result->isSuccess())
		{
			$referral->refreshId($modal->getId());
			return $referral;
		}

		return null;
	}

	public function findAll(Criteria $criteria): array
	{
		$result = [];
		$models = ReferralTable::getList($criteria->makeGetListParams())->fetchCollection();

		foreach($models as $referral)
		{
			$result[] = $this->hydrate($referral);
		}

		return $result;
	}

	public function findByUserId(int $userId): ?ReferralEntity
	{
		$listModels = $this->findAll(Criteria::instance()->filter([
			ReferralTable::F_USER_ID => $userId,
		]));

		if(count($listModels) !== 1)
		{
			return null;
		}

		return array_shift($listModels);
	}

	public function findByCode(string $code): ?ReferralEntity
	{
		return null;
	}

	private function hydrate(EO_Referral $referral): ReferralEntity
	{
		return ReferralEntity::hydrate(
			$referral->getId(),
			new ActiveValueObject($referral->getActive()),
			$referral->getUserId(),
			$referral->getInvitedUserId(),
			$referral->getCode(),
			new PhoneValueObject($referral->getPhone()),
		);
	}

	public function countInvitedMembers(int $userId): int
	{
		return ReferralTable::getList([
			'filter' => [
				ReferralTable::F_INVITED_USER_ID => $userId,
			],
		])->getSelectedRowsCount();
	}
}