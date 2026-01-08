<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Application\Dto\InviteDto;
use Craft\DDD\Referal\Application\Facade\StorageManager;
use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class InviteUseCase
{

	public function __construct(
		protected ReferralRepositoryInterface $referralRepository,
		protected StorageManager              $storageManager,
	)
	{
	}

	public function execute(int $userId): void
	{
		$code = $this->getCode();

		$guest = $this->referralRepository->findByUserId($userId);
		if(!$guest)
		{
			throw new \Exception('');
		}


		$invited = $this->referralRepository->findByCode($code);
		if(!$invited)
		{
			throw new \Exception('');
		}

		$invited = $invited->invite($guest);

		$this->referralRepository->update($invited);
		$this->referralRepository->update($guest);

	}

	private function getCode(): ?string
	{
		return $this->storageManager->getCode();
	}
}