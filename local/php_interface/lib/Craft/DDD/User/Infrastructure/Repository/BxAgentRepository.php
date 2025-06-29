<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\Model\CraftUserTable;

class BxAgentRepository implements AgentRepositoryInterface
{
	public function create(AgentEntity $agent): ?AgentEntity
	{
		$model = new \CUser();

		$result = $model->Add([
			CraftUserTable::F_EMAIL            => $agent->getEmail()->getValue(),
			CraftUserTable::F_LOGIN            => $agent->getEmail()->getValue(),
			CraftUserTable::F_PASSWORD         => $agent->getPassword()->getValue(),
			CraftUserTable::F_PERSONAL_PHONE   => $agent->getPhone()->getValue(),
			CraftUserTable::F_UF_KPP           => $agent->getKpp()->getValue(),
			CraftUserTable::F_UF_INN           => $agent->getInn()->getValue(),
			CraftUserTable::F_UF_OGRN          => $agent->getOgrn()->getValue(),
			CraftUserTable::F_UF_BIK           => $agent->getBik()->getValue(),
			CraftUserTable::F_UF_CURR_ACC      => $agent->getCurrAcc()->getValue(),
			CraftUserTable::F_UF_CORR_ACC      => $agent->getCorrAcc()->getValue(),
			CraftUserTable::F_UF_LEGAL_ADDRESS => $agent->getLegalAddress(),
			CraftUserTable::F_UF_POST_ADDRESS  => $agent->getPostAddress(),
			CraftUserTable::F_UF_BANK_NAME     => $agent->getBankName(),
		]);

		if($result)
		{
			$agent->refreshIdAfterRegister($result);
			return $agent;
		}

		return null;
	}

	public function findByInn(InnValueObject $inn): ?AgentEntity
	{
		return null;
	}

	public function findByPhone(PhoneValueObject $phone): ?AgentEntity
	{
		return null;
	}
}