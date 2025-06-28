<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;

class BxAgentRepository implements AgentRepositoryInterface
{
	public function create(AgentEntity $agent): ?AgentEntity
	{
		$model = new \CUser();

		$result = $model->Add([
			CraftUserTable::F_EMAIL => $agent->getEmail(),
		]);

		if($result)
		{
			$agent->refreshIdAfterRegister($result);
			return $agent;
		}

		return null;
	}
}