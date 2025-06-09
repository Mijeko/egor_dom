<?php

namespace Craft\DDD\Claims\Infrastructure\Repository;

use Craft\DDD\Claims\Domain\Entity\Claim;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;
use Craft\DDD\Claims\Infrastructure\Entity\Claim as BxClaim;
use Craft\DDD\Objects\Domain\BuildObject;

class OrmClaimRepository implements ClaimRepositoryInterface
{
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


	protected function mapObject(BxClaim $claim): Claim
	{
		return new Claim(
			$claim->getId(),
			$claim->getName(),
			new BuildObject()
		);
	}
}