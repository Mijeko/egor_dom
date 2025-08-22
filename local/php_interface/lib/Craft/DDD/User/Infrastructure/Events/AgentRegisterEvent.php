<?php

namespace Craft\DDD\User\Infrastructure\Events;

use Craft\DDD\User\Domain\Entity\AgentEntity;
use Symfony\Contracts\EventDispatcher\Event;

class AgentRegisterEvent extends Event
{
	public function __construct(
		private AgentEntity $agent
	)
	{
	}

	public function getAgent(): AgentEntity
	{
		return $this->agent;
	}
}