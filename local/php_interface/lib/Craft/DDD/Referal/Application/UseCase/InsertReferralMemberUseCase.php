<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Application\Dto\InsertReferralDto;
use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class InsertReferralMemberUseCase
{

	public function __construct(
		protected ReferralRepositoryInterface $referralRepository,
	)
	{
	}

	public function execute(InsertReferralDto $dto): void
	{

		if($this->referralRepository->findByUserId($dto->userId))
		{
			return;
		}

		$referralEntity = ReferralEntity::create(
			$dto->userId,
			new PhoneValueObject($dto->phone),
			uniqid(),
		);

		$this->referralRepository->create($referralEntity);

	}
}