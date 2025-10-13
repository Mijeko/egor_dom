<?php

namespace Craft\DDD\Claims\Infrastructure\Events;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Symfony\Contracts\EventDispatcher\Event;

class ClaimAcceptManagerEvent extends Event
{
	const string EVENT_NAME = 'claimAcceptManagerEvent';

	public function __construct(
		private readonly ClaimEntity $claim,
	)
	{
	}

	public function getClaim(): ClaimEntity
	{
		return $this->claim;
	}
}