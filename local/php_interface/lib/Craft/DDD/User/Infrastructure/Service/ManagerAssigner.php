<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Craft\DDD\User\Application\Service\Interfaces\ManagerAssignerInterface;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\Model\CraftUserTable;

class ManagerAssigner implements ManagerAssignerInterface
{

	public function __construct(
		protected ManagerRepositoryInterface $managerRepository,
		protected AgentRepositoryInterface   $agentRepository,
	)
	{
	}

	public function assign(AgentEntity $agent): void
	{
		$managers = $this->managerRepository->findAll();

		if(count($managers) == 0)
		{
			return;
		}

		$randomIndex = rand(0, count($managers) - 1);

		$manager = $managers[$randomIndex];

		$agent->assignManager($manager);
		$this->agentRepository->update($agent);
	}
}