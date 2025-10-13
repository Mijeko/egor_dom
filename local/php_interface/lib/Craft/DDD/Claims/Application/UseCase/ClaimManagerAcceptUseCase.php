<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Present\Dto\ClaimDto;

class ClaimManagerAcceptUseCase
{
	public function __construct(
		protected ClaimRepositoryInterface $claimRepository,
	)
	{
	}

	public function execute(int $orderId): ClaimDto
	{
		$claim = $this->claimRepository->findById($orderId);
		if(!$claim)
		{
			throw new \Exception("Заказ не найден");
		}

		$claim->developerAccept();

		$claim = $this->claimRepository->update($claim);

		return ClaimDto::fromEntity($claim);
	}
}