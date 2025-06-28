<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\AgentEntity;

interface AgentRepositoryInterface
{
	public function create(AgentEntity $agent): ?AgentEntity;
}