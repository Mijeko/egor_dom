<?php

namespace Craft\DDD\Claims\Application\Services\NotifyChannel;

use Craft\DDD\Claims\Application\Interfaces\TgSenderInterface;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Entity\ManagerEntity;

class TelegramNotifyService
{
	public function __construct(
		protected TgSenderInterface $tgNotifyService,
	)
	{
	}


	/**
	 * @param ManagerEntity[] $members
	 * @param ClaimEntity $claimEntity
	 */
	public function aboutNewClaim(array $members, ClaimEntity $claimEntity): void
	{
		$message = "";

		foreach($members as $member)
		{
			$this->tgNotifyService->send(
				$member->getAvailChannelContact()->getChannelTg()->getTgId(),
				$message
			);
		}
	}
}