<?php

namespace Craft\DDD\Claims\Infrastructure\Repository;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Domain\ValueObject\StatusValueObject;
use Craft\DDD\Claims\Infrastructure\Entity\Claim;
use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;
use Craft\DDD\Shared\Domain\ValueObject\BikValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\KppValueObject;
use Craft\DDD\Shared\Domain\ValueObject\OgrnValueObject;
use Craft\Helper\Criteria;

class OrmClaimRepository implements ClaimRepositoryInterface
{

	public function create(ClaimEntity $claim): ClaimEntity
	{
		$model = ClaimTable::createObject();
		$model->setUserId($claim->getUser()->getId());
		$model->setApartmentId($claim->getApartmentEntity()->getId());
		$model->setClient($claim->getClient());
		$model->setName($claim->getName());
		$model->setStatus($claim->getStatus()->getCode());
		$model->setPhone($claim->getPhone());
		$model->setEmail($claim->getEmail());
		$model->setOrderCost($claim->getOrderCost());
		$model->setManagerId($claim->getManagerId());

		$result = $model->save();

		if($result->isSuccess())
		{
			$claim->refreshIdAfterCreate($model->getId());
			return $claim;
		}

		throw new \Exception(implode("\n", $result->getErrors()));
	}

	public function findAll(Criteria $criteria = null): array
	{
		$result = [];

		$claimList = ClaimTable::getList($criteria?->makeGetListParams() ?? [])
			->fetchCollection();

		foreach($claimList as $claim)
		{
			$result[] = $this->hydrate($claim);
		}

		return $result;
	}

	public function findById(int $claimId): ?ClaimEntity
	{
		$items = $this->findAll(Criteria::instance(
			[],
			[
				ClaimTable::F_ID => $claimId,
			]
		));

		if(count($items) != 1)
		{
			return null;
		}

		return array_shift($items);
	}

	public function findAllByUserId(int $userId, array $order = []): array
	{
		$result = [];

		$query = ClaimTable::getList([
			'order'  => $order,
			'filter' => [
				ClaimTable::F_USER_ID => $userId,
			],
		]);

		foreach($query->fetchCollection() as $claim)
		{
			$result[] = $this->hydrate($claim);
		}

		return $result;
	}


	protected function hydrate(Claim $claim): ClaimEntity
	{
		return ClaimEntity::hydrate(
			$claim->getId(),
			$claim->getApartmentId(),
			$claim->getUserId(),
			$claim->getManagerId(),
			$claim->getName(),
			new StatusValueObject($claim->getStatus()),
			$claim->getEmail(),
			$claim->getPhone(),
			$claim->getClient(),
			$claim->getCreatedAt()->format('d.m.Y H:i:s'),
			$claim->getIsClosed(),
			$claim->getIsMoneyReceived(),
			$claim->getCostReward(),
		);
	}

	public function update(ClaimEntity $claim): ?ClaimEntity
	{
		return null;
	}

	public function findAllByManagerId(int $managerId): array
	{
		return $this->findAll(Criteria::instance(
			[],
			[
				ClaimTable::F_MANAGER_ID => $managerId,
			],
		));
	}
}