<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\Dto\BxUserDto;

class CraftAgentListComponent extends AjaxComponent
{

	protected AgentRepositoryInterface $agentRepository;

	function componentNamespace(): string
	{
		return 'craftAgentList';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{
		$agents = $this->agentRepository->findAll();
		if(!$agents)
		{
			throw new Exception("Агенты не найдены");
		}


		$this->arResult['AGENTS'] = array_map(function(AgentEntity $agent) {
			return BxUserDto::agent(
				$agent->getId(),
				$agent->getName(),
				$agent->getLastName(),
				$agent->getSecondName(),
				$agent->fullName(),
				$agent->getEmail()->getValue(),
				$agent->getPhone()->getValue(),
			);
		}, $agents);
	}

	public function loadServices(): void
	{
		$this->agentRepository = new BxAgentRepository();
	}
}