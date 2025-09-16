<?php

namespace Craft\DDD\Claims\Infrastructure\Repository;

use Craft\DDD\Claims\Domain\Entity\BuyerEntity;
use Craft\DDD\Claims\Domain\Repository\BuyerRepositoryInterface;
use Craft\DDD\Claims\Domain\ValueObject\BuyerManagerIdValueObject;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\Helper\Criteria;
use Craft\Model\CraftUserTable;
use Craft\Model\EO_CraftUser;

class BuyerRepository implements BuyerRepositoryInterface
{

	public function findAll(Criteria $criteria): array
	{
		$result = [];
		$items = CraftUserTable::getList($criteria?->makeGetListParams() ?? [])
			->fetchCollection();

		foreach($items as $item)
		{
			$result[] = $this->hydrate($item);
		}

		return $result;
	}

	public function findById(int $id): ?BuyerEntity
	{
		$items = $this->findAll(Criteria::instance(
			[],
			[
				CraftUserTable::F_ID => $id,
			]
		));

		if(count($items) !== 1)
		{
			return null;
		}

		return array_shift($items);
	}

	private function hydrate(EO_CraftUser $user): BuyerEntity
	{
		return BuyerEntity::hydrate(
			$user->getId(),
			new BuyerManagerIdValueObject($user->fillUfPersonalManager()),
			new PhoneValueObject($user->getPersonalMobile()),
			new EmailValueObject($user->getEmail()),
		);
	}
}