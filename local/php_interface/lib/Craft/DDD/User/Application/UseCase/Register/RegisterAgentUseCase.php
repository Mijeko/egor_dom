<?php

namespace Craft\DDD\User\Application\UseCase\Register;

use Craft\DDD\Shared\Domain\ValueObject\BikValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\KppValueObject;
use Craft\DDD\Shared\Domain\ValueObject\OgrnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\Shared\Infrastructure\Service\EventManagerInterface;
use Craft\DDD\User\Application\Dto\RegisterSimpleAgentDto;
use Craft\DDD\User\Application\Contract\AuthenticatorInterface;
use Craft\DDD\User\Application\Contract\GroupAssignInterface;
use Craft\DDD\User\Application\Contract\ManagerAssignerInterface;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Events\AgentRegisterEvent;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;

class RegisterAgentUseCase
{
	public function __construct(
		protected AgentRepositoryInterface $agentRepository,
		protected AttachPhoneService       $attachPhoneService,
		protected AuthenticatorInterface   $authenticator,
		protected GroupAssignInterface     $groupAssignService,
		protected ManagerAssignerInterface $managerAssignerService,
		protected EventManagerInterface $eventDispatcher
	)
	{
	}

	public function execute(RegisterSimpleAgentDto $registerAgentDto): ?AgentEntity
	{
		$specialPhone = \COption::GetOptionString('main', 'new_user_phone_auth') == 'Y';

		if($specialPhone)
		{
			if($this->attachPhoneService->isExist($registerAgentDto->phone))
			{
				throw new \Exception("Пользователь с таким номером телефона уже существует");
			}
		} else
		{
			if($this->agentRepository->findByPhone(new PhoneValueObject($registerAgentDto->phone)))
			{
				throw new \Exception("Пользователь с таким номером телефона уже существует");
			}
		}


		$agent = AgentEntity::simpleRegister(
			new PhoneValueObject($registerAgentDto->phone),
			new EmailValueObject($registerAgentDto->email),
			new PasswordValueObject($registerAgentDto->password),
		);

		$agent = $this->agentRepository->create($agent);

		if($specialPhone)
		{
			$this->attachPhoneService->attach(
				$agent->getId(),
				$agent->getPhone()->getValue()
			);
		}

		$this->groupAssignService->assign(
			[USER_GROUP_EXTERNAL_REALTOR],
			$agent->getId(),
		);

		$this->authenticator->loginById(
			$agent->getId(),
		);

		$this->managerAssignerService->assignManagerToAgent($agent);

		$this->eventDispatcher->dispatch(
			new AgentRegisterEvent($agent)
		);

		return $agent;
	}
}