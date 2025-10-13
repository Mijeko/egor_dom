<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Infrastructure\Events\ClaimAcceptManagerEvent;
use Craft\DDD\Claims\Present\Dto\ClaimDto;
use Craft\DDD\Shared\Infrastructure\Service\EventManager;

class ClaimAcceptDeveloperUseCase
{
	public function __construct(
		protected ClaimRepositoryInterface $claimRepository,
		protected EventManager             $eventManager,
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

		$this->eventManager->dispatch(
			new ClaimAcceptManagerEvent($claim),
			ClaimAcceptManagerEvent::EVENT_NAME
		);

		return ClaimDto::fromEntity($claim);
	}
}