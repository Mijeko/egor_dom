<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Application\Dto\JoinClientToClientDto;
use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;

class InviteClientUseCase
{

	public function __construct(
		protected ReferralRepositoryInterface $referralRepository,
	)
	{
	}

	public function execute(JoinClientToClientDto $clientDto): void
	{
		$refAssign = $this->referralRepository->findByCode($clientDto->code);
		if(!$refAssign)
		{
			throw new \Exception('Реферал не существует');
		}

		$invitedReferral = ReferralEntity::invite(
			$clientDto->phone,
			$clientDto->code,
		);

		$this->referralRepository->create($invitedReferral);
	}
}