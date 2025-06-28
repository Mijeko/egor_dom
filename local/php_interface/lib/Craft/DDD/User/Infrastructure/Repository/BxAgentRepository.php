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
		$model = CraftUserTable::createObject();


		#$model->addToGroups();

		$result = $model->save();

		if($result->isSuccess())
		{
			$agent->refreshIdAfterRegister($model->getId());
			return $agent;
		}

		return null;
	}
}