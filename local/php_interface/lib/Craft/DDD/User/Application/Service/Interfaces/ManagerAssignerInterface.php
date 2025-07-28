<?php

namespace Craft\DDD\User\Application\Service\Interfaces;

use Craft\DDD\User\Domain\Entity\AgentEntity;

interface ManagerAssignerInterface
{
	public function assign(AgentEntity $agent): void;
}