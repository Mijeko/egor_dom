<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Craft\DDD\User\Application\Service\Interfaces\ManagerAssignerInterface;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Entity\StudentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Domain\Repository\StudentRepositoryInterface;
use Craft\Model\CraftUserTable;

class ManagerAssigner implements ManagerAssignerInterface
{

	public function __construct(
		protected ManagerRepositoryInterface $managerRepository,
		protected AgentRepositoryInterface   $agentRepository,
		protected StudentRepositoryInterface $studentRepository
	)
	{
	}

	public function assignManagerToAgent(AgentEntity $agent): void
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

	public function assignManagerToStudent(StudentEntity $studentEntity): void
	{
		$managers = $this->managerRepository->findAll();

		if(count($managers) == 0)
		{
			return;
		}

		$randomIndex = rand(0, count($managers) - 1);

		$manager = $managers[$randomIndex];

		$studentEntity->assignManager($manager);
		$this->studentRepository->update($studentEntity);
	}
}