<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Application\Interfaces\TgNotifyInterface;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;

class NotifyManagerAboutFreshClaim
{
	public function __construct(
		protected TgNotifyInterface $tgNotify,
	)
	{
	}

	public function execute(ClaimEntity $claim): void
	{
		$message = 'Новая заявка: №' . $claim->getId();
		$this->tgNotify->notify($message);
	}
}