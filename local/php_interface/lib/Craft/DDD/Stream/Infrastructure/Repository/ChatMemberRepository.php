<?php

namespace Craft\DDD\Stream\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Stream\Domain\Entity\ChatMemberEntity;
use Craft\DDD\Stream\Domain\Repository\MemberRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatMemberTable;
use Craft\DDD\Stream\Infrastructure\Entity\EO_ChatMember;
use Craft\Helper\Criteria;

class ChatMemberRepository implements MemberRepositoryInterface
{

	public function create(ChatMemberEntity $member): ?ChatMemberEntity
	{
		$model = ChatMemberTable::createObject();
		$model->setUserId($member->getUserId());
		$model->setChatId($member->getChatId());

		$result = $model->save();

		if($result->isSuccess())
		{
			$member->refreshId($model->getId());
			return $member;
		}


		throw new \Exception(implode("\n", $result->getErrorMessages()));
	}

	public function findAll(Criteria $criteria = null): array
	{
		$result = [];

		$members = ChatMemberTable::getList($criteria ? $criteria->makeGetListParams() : []);
		$members = $members->fetchCollection();

		foreach($members as $member)
		{
			$result[] = $this->hydrate($member);
		}

		return $result;
	}

	private function hydrate(EO_ChatMember $chatMember): ChatMemberEntity
	{
		return ChatMemberEntity::hydrate(
			$chatMember->getId(),
			$chatMember->getChatId(),
			$chatMember->getUserId(),
		);
	}
}