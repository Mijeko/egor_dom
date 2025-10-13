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
		$claimEntity = $this->claimRepository->findById($orderId);
		if(!$claimEntity)
		{
			throw new \Exception("Заказ не найден");
		}

		$claimEntity->developerAccept();

		$claimEntity = $this->claimRepository->update($claimEntity);

		$this->eventManager->dispatch(
			new ClaimAcceptManagerEvent($claimEntity),
			ClaimAcceptManagerEvent::EVENT_NAME
		);

		return ClaimDto::fromEntity($claimEntity);
	}
}