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

	/**
	 * @param int $userId
	 * @return null
	 * @throws \Exception
	 */
	public function execute(int $userId): null
	{
		$code = $this->getCode();

		$guest = $this->referralRepository->findByUserId($userId);
		if(!$guest)
		{
			throw new \Exception('Реферал-гость не найден');
		}


		$invited = $this->referralRepository->findByCode($code);
		if(!$invited)
		{
			throw new \Exception('Реферал не найден');
		}

		$invited = $invited->invite($guest);

		$this->referralRepository->update($invited);
		$this->referralRepository->update($guest);

		return null;
	}

	private function getCode(): ?string
	{
		return $this->storageManager->getCode();
	}
}