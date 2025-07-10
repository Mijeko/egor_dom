<?php

namespace Craft\DDD\Claims\Infrastructure\Repository;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Infrastructure\Entity\Claim;
use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;

class OrmClaimRepository implements ClaimRepositoryInterface
{

	public function create(ClaimEntity $claim): ?ClaimEntity
	{
		$model = ClaimTable::createObject();
		$model->setUserId($claim->getUser()->getId());
		$model->setApartmentId($claim->getApartmentEntity()->getId());
		$model->setClient($claim->getClient());
		$model->setName($claim->getName());
		$model->setPhone($claim->getPhone());
		$model->setEmail($claim->getEmail());
		$model->setOgrn($claim->getOgrn()->getValue());
		$model->setInn($claim->getInn()->getValue());
		$model->setKpp($claim->getKpp()->getValue());
		$model->setBik($claim->getBik()->getValue());
		$model->setCurrAcc($claim->getCurrAcc()->getValue());
		$model->setCorrAcc($claim->getCorrAcc()->getValue());
		$model->setLegalAddress($claim->getLegalAddress());
		$model->setPostAddress($claim->getPostAddress());
		$model->setBankName($claim->getBankName());


		$result = $model->save();

		if($result->isSuccess())
		{
			$claim->refreshIdAfterCreate($model->getId());
			return $claim;
		}

		throw new \Exception(implode("\n", $result->getErrors()));
	}

	public function getAll(): array
	{
		$result = [];

		$query = ClaimTable::getList();

		foreach($query->fetchCollection() as $claim)
		{
			$result[] = $this->mapObject($claim);
		}

		return $result;
	}

	public function getAllByUserId(int $userId): array
	{
		$result = [];

		$query = ClaimTable::getList([
			'filter' => [
				ClaimTable::F_USER_ID => $userId,
			],
		]);

		foreach($query->fetchCollection() as $claim)
		{
			$result[] = $this->mapObject($claim);
		}

		return $result;
	}


	protected function mapObject(Claim $claim): ClaimEntity
	{
		return ClaimEntity::hydrate($claim);
	}
}