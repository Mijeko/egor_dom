<?php

namespace Craft\DDD\Claims\Application\Services\NotifyChannel;

use Craft\DDD\Claims\Application\Interfaces\EmailSenderInterface;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Entity\ManagerEntity;

class EmailNotifyService
{

	public function __construct(
		protected EmailSenderInterface $emailSender,
	)
	{

	}


	/**
	 * @param ManagerEntity[] $members
	 * @param ClaimEntity $claimEntity
	 */
	public function aboutNewClaim(array $members, ClaimEntity $claimEntity): void
	{
		$message = '';

		foreach($members as $member)
		{
			$this->emailSender->send(
				$member->getAvailChannelContact()->getChannelEmail()->getEmail(),
				$message
			);
		}
	}
}