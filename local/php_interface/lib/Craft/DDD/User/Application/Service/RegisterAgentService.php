<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\Shared\Domain\ValueObject\BikValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\KppValueObject;
use Craft\DDD\Shared\Domain\ValueObject\OgrnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Application\Dto\RegisterAgentDto;
use Craft\DDD\User\Application\Service\Interfaces\AutenficatorInterface;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;

class RegisterAgentService
{
	public function __construct(
		protected AgentRepositoryInterface $agentRepository,
		protected AttachPhoneService       $attachPhoneService,
		protected AutenficatorInterface    $autenficator,
	)
	{
	}

	public function execute(RegisterAgentDto $registerAgentDto): ?AgentEntity
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

		if($this->agentRepository->findByInn(new InnValueObject($registerAgentDto->inn)))
		{
			throw new \Exception('Пользователь с таким ИНН уже существует');
		}

		$agent = AgentEntity::register(
			new PhoneValueObject($registerAgentDto->phone),
			new EmailValueObject($registerAgentDto->email),
			new PasswordValueObject($registerAgentDto->password),
			new InnValueObject($registerAgentDto->inn),
			new KppValueObject($registerAgentDto->kpp),
			new OgrnValueObject($registerAgentDto->ogrn),
			new BikValueObject($registerAgentDto->bik),
			new CurrAccountValueObject($registerAgentDto->currAcc),
			new CorrAccountValueObject($registerAgentDto->corrAcc),
			$registerAgentDto->postAddress,
			$registerAgentDto->legalAddress,
			$registerAgentDto->bankName,
		);


		$agent = $this->agentRepository->create($agent);

		if($specialPhone)
		{
			$this->attachPhoneService->attach(
				$agent->getId(),
				$agent->getPhone()->getValue()
			);
		}


		$this->autenficator->loginById(
			$agent->getId(),
		);

		return $agent;
	}
}