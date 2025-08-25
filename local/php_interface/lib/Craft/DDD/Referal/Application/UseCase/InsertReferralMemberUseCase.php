<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;

class InsertReferralMemberUseCase
{

	public function __construct(
		protected ReferralRepositoryInterface $referralRepository,
	)
	{
	}

	public function execute(int $userId): void
	{

		if($this->referralRepository->findByUserId($userId))
		{
			return;
		}

		$referralEntity = ReferralEntity::create(
			$userId,
			uniqid()
		);

		$this->referralRepository->create($referralEntity);

	}
}