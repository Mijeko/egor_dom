<?php

namespace Craft\DDD\Claims\Infrastructure\Events;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Symfony\Contracts\EventDispatcher\Event;

class ClaimCreateEvent extends Event
{
	const string EVENT_NAME = 'claimCreateEvent';

	public function __construct(
		private ClaimEntity $claim,
	)
	{
	}

	public function getClaim(): ClaimEntity
	{
		return $this->claim;
	}
}