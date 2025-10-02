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

	/**
	 * @return array<int, int>
	 */
	public function findChatBetweenUsers(int $userId1, int $userId2): ?int
	{
		$chatData = ChatMemberTable::query()
			->setSelect([
				ChatMemberTable::F_CHAT_ID,
			])
			->where([
				[ChatMemberTable::F_USER_ID, $userId1],
				[ChatMemberTable::F_USER_ID, $userId2],
			])
			->addGroup(ChatMemberTable::F_CHAT_ID)
			->fetchAll();

		if(count($chatData) == 1)
		{
			$chatData = array_shift($chatData);
			if($chatData && $chatData['CHAT_ID'])
			{
				return $chatData['CHAT_ID'];
			}
		}

		return null;
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