<?php

namespace Craft\DDD\User\Application\UseCase\Crud;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Application\Dto\Request\CreateAgentRequestDto;
use Craft\DDD\User\Application\Contract\GroupAssignInterface;
use Craft\DDD\User\Application\Contract\PasswordGeneratorInterface;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;

class CreateAgentUseCase
{

	public function __construct(
		protected AgentRepositoryInterface   $agentRepository,
		protected ManagerRepositoryInterface $managerRepository,
		protected GroupAssignInterface       $groupAssign,
		protected PasswordGeneratorInterface $passwordGenerator,
	)
	{

	}

	public function execute(CreateAgentRequestDto $agentRequestDto): void
	{
		if(!$this->managerRepository->findById($agentRequestDto->managerId))
		{
			throw new \Exception("Выбранный менеджер не существует.");
		}

		$agent = AgentEntity::createAgent(
			new PasswordValueObject($this->passwordGenerator->generate()),
			$agentRequestDto->name,
			$agentRequestDto->lastName,
			$agentRequestDto->secondName,
			new EmailValueObject($agentRequestDto->email),
			new PhoneValueObject($agentRequestDto->phone)
		);

		$agent = $this->agentRepository->create($agent);

		if(!$agent->getId())
		{
			throw new \Exception('Ошибка при создании агента');
		}

		$this->groupAssign->assign(
			[USER_GROUP_AGENT],
			$agent->getId()
		);
	}
}