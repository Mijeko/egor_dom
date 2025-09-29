<?php

namespace Craft\DDD\Stream\Infrastructure\Repository;

use Craft\DDD\Stream\Domain\Entity\MemberEntity;
use Craft\DDD\Stream\Domain\Repository\MemberRepositoryInterface;
use Craft\Helper\Criteria;
use Craft\Model\CraftUserTable;
use Craft\Model\EO_CraftUser;

class ChatMemberRepository implements MemberRepositoryInterface
{
	public function findAll(Criteria $criteria = null): array
	{
		$result = [];
		$model = CraftUserTable::getList($criteria ? $criteria->makeGetListParams() : [])
			->fetchCollection();

		foreach($model as $member)
		{
			$result[] = $this->hydrate($member);
		}

		return $result;
	}

	private function hydrate(EO_CraftUser $user): MemberEntity
	{
		return MemberEntity::hydrate(
			$user->getId(),
			$user->getName(),
			$user->getPersonalPhoto(),
		);
	}
}