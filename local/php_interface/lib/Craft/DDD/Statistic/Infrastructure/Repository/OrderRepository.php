<?php

namespace Craft\DDD\Statistic\Infrastructure\Repository;

use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;
use Craft\DDD\Claims\Infrastructure\Entity\EO_Claim;
use Craft\DDD\Statistic\Domain\Entity\OrderEntity;
use Craft\DDD\Statistic\Domain\Repository\OrderRepositoryInterface;
use Craft\Helper\Criteria;

class OrderRepository implements OrderRepositoryInterface
{
	public function findAll(Criteria $criteria = null): array
	{
		$result = [];
		$models = ClaimTable::getList($criteria ? $criteria->makeGetListParams() : [])
			->fetchCollection();

		foreach($models as $model)
		{
			$result[] = $this->hydrate($model);
		}

		return $result;
	}

	public function findById(int $orderId): ?OrderEntity
	{
		$modelList = $this->findAll(Criteria::instance()->filter([
			ClaimTable::F_ID => $orderId,
		]));

		if(count($modelList) !== 1)
		{
			return null;
		}

		return array_shift($modelList);
	}

	private function hydrate(EO_Claim $claim): OrderEntity
	{
		return OrderEntity::hydrate(
			$claim->getId(),
			$claim->getOrderCost(),
		);
	}

	public function findAllByUserId(int $userId): array
	{
		return $this->findAll(Criteria::instance()->filter([
			ClaimTable::F_USER_ID => $userId,
		]));
	}
}