<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\ExternalRealtor;
use Craft\DDD\User\Domain\Repository\ExternalRealtorRepositoryInterface;
use Craft\Helper\Criteria;
use Craft\Model\CraftUserTable;
use Craft\Model\EO_CraftUser;

class ExternalRealtorRepository implements ExternalRealtorRepositoryInterface
{
	public function findAll(Criteria $criteria): array
	{
		$result = [];

		$agentList = CraftUserTable::query()
			->addFilter(null, $criteria->getFilter())
			->withExtRealtor()
			->fetchCollection();


		foreach($agentList as $agent)
		{
			$result[] = $this->hydrate($agent);
		}

		return $result;
	}

	public function findById(int $id): ?ExternalRealtor
	{
		$list = $this->findAll(
			Criteria::instance()->filter([
				CraftUserTable::F_ID => $id,
			])
		);

		if(count($list) !== 1)
		{
			return null;
		}

		return array_shift($list);
	}

	private function hydrate(EO_CraftUser $user): ExternalRealtor
	{
		return ExternalRealtor::hydrate(
			$user->getId(),
			$user->getName(),
			$user->getLastName(),
			$user->getSecondName(),
			new EmailValueObject($user->getEmail()),
			new PhoneValueObject($user->getPersonalMobile()),
			$user->getPersonalPhoto()
		);
	}
}