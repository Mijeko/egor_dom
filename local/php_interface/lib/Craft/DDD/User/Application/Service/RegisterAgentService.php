<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\Claims\Domain\ValueObject\BikValueObject;
use Craft\DDD\Claims\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Claims\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Claims\Domain\ValueObject\InnValueObject;
use Craft\DDD\Claims\Domain\ValueObject\KppValueObject;
use Craft\DDD\Claims\Domain\ValueObject\OgrnValueObject;
use Craft\DDD\User\Application\Dto\RegisterAgentDto;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;

class RegisterAgentService
{
	public function __construct(
		protected AgentRepositoryInterface $agentRepository
	)
	{
	}

	public function execute(RegisterAgentDto $registerAgentDto): ?AgentEntity
	{
		$agent = AgentEntity::register(
			$registerAgentDto->phone,
			$registerAgentDto->password,
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
		return $this->agentRepository->create($agent);
	}
}