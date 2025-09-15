<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Shared\Domain\ValueObject\BikValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\KppValueObject;
use Craft\DDD\Shared\Domain\ValueObject\OgrnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\Helper\Criteria;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;

class BxAgentRepository implements AgentRepositoryInterface
{
	public function create(AgentEntity $agent): ?AgentEntity
	{
		$model = new \CUser();
		$result = $model->Add($this->fillParams($agent));

		if($result)
		{
			$agent->refreshIdAfterRegister($result);
			return $agent;
		}

		return null;
	}

	public function findAll(Criteria $criteria = null): array
	{
		$result = [];

		$agentList = CraftUserTable::query();

		if($criteria)
		{
			if($criteria->getFilter())
			{
				$agentList->setFilter($criteria->getFilter());
			}
		}

		$agentList->withAgent();

		$agentList = $agentList->fetchCollection();
		foreach($agentList as $agent)
		{
			try
			{
				$result[] = $this->hydrate($agent);
			} catch(\Exception|\TypeError $exception)
			{
			}
		}

		return $result;
	}

	public function findById(int $id): ?AgentEntity
	{
		$agentList = $this->findAll(
			Criteria::instance()
				->filter([
					CraftUserTable::F_ID => $id,
				])
		);

		if(count($agentList) !== 1)
		{
			return null;
		}

		return array_shift($agentList);
	}

	public function findByInn(InnValueObject $inn): ?AgentEntity
	{
		return null;
	}

	public function findByPhone(PhoneValueObject $phone): ?AgentEntity
	{
		return null;
	}

	public function update(AgentEntity $agent): ?AgentEntity
	{
		$model = new \CUser();
		$result = $model->Update(
			$agent->getId(),
			$this->fillParams($agent),
		);

		if($result)
		{
			return $agent;
		}

		return null;
	}

	private function fillParams(AgentEntity $agent): array
	{
		return [
			CraftUserTable::F_EMAIL               => $agent->getEmail()->getValue(),
			CraftUserTable::F_LOGIN               => $agent->getEmail()->getValue(),
			CraftUserTable::F_PASSWORD            => $agent->getPassword()->getValue(),
			CraftUserTable::F_PERSONAL_PHONE      => $agent->getPhone()->getValue(),
			CraftUserTable::F_UF_KPP              => $agent->getKpp()->getValue(),
			CraftUserTable::F_UF_INN              => $agent->getInn()->getValue(),
			CraftUserTable::F_UF_OGRN             => $agent->getOgrn()->getValue(),
			CraftUserTable::F_UF_BIK              => $agent->getBik()->getValue(),
			CraftUserTable::F_UF_CURR_ACC         => $agent->getCurrAcc()->getValue(),
			CraftUserTable::F_UF_CORR_ACC         => $agent->getCorrAcc()->getValue(),
			CraftUserTable::F_UF_LEGAL_ADDRESS    => $agent->getLegalAddress(),
			CraftUserTable::F_UF_POST_ADDRESS     => $agent->getPostAddress(),
			CraftUserTable::F_UF_BANK_NAME        => $agent->getBankName(),
			CraftUserTable::F_UF_PERSONAL_MANAGER => $agent->getPersonalManagerId(),
		];
	}

	private function hydrate(CraftUser $model): AgentEntity
	{
		return AgentEntity::hydrate(
		// @phpstan-ignore method.notFound
			$model->getId(),
			// @phpstan-ignore method.notFound
			$model->getName(),
			// @phpstan-ignore method.notFound
			$model->getLastName(),
			// @phpstan-ignore method.notFound
			$model->getSecondName(),
			new PasswordValueObject(rand()),
			// @phpstan-ignore method.notFound
			new PhoneValueObject($model->fillPersonalMobile()),
			// @phpstan-ignore method.notFound
			new EmailValueObject($model->getEmail()),
			// @phpstan-ignore method.notFound
			new InnValueObject($model->fillUfInn()),
			// @phpstan-ignore method.notFound
			new KppValueObject($model->fillUfKpp()),
			// @phpstan-ignore method.notFound
			new OgrnValueObject($model->fillUfOgrn()),
			// @phpstan-ignore method.notFound
			new BikValueObject($model->fillUfBik()),
			// @phpstan-ignore method.notFound
			new CurrAccountValueObject($model->fillUfCurrAcc()),
			// @phpstan-ignore method.notFound
			new CorrAccountValueObject($model->fillUfCorrAcc()),
			// @phpstan-ignore method.notFound
			$model->fillUfPostAddress(),
			// @phpstan-ignore method.notFound
			$model->fillUfLegalAddress(),
			// @phpstan-ignore method.notFound
			$model->fillUfBankName(),
			// @phpstan-ignore method.notFound
			$model->fillUfPersonalManager(),

		);
	}
}