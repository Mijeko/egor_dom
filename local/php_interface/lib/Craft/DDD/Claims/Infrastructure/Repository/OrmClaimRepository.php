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

	public function findAll(array $order = [], array $filter = []): array
	{
		$result = [];

		$query = ClaimTable::getList([
			'order'  => $order,
			'filter' => $filter,
		]);

		foreach($query->fetchCollection() as $claim)
		{
			$result[] = $this->hydrate($claim);
		}

		return $result;
	}

	public function findById(int $claimId): ?ClaimEntity
	{
		$object = ClaimTable::getByPrimary($claimId)->fetchObject();
		if(!$object)
		{
			throw new \Exception("Заявка не найдена");
		}

		return $this->hydrate($object);
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
		return new ClaimEntity(
			$claim->getId(),
			$claim->getName(),
			new StatusValueObject($claim->getStatus()),
			$claim->getEmail(),
			$claim->getPhone(),
			$claim->getClient(),
			new InnValueObject($claim->getInn()),
			new KppValueObject($claim->getKpp()),
			new BikValueObject($claim->getBik()),
			new OgrnValueObject($claim->getOgrn()),
			new CurrAccountValueObject($claim->getCurrAcc()),
			new CorrAccountValueObject($claim->getCorrAcc()),
			$claim->getLegalAddress(),
			$claim->getPostAddress(),
			$claim->getBankName(),
			$claim->getApartmentId(),
			$claim->getUserId(),
			null,
			null,
			$claim->getCreatedAt()->format('d.m.Y H:i:s'),
		);
	}
}