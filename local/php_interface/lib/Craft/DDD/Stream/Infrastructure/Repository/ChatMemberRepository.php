<?php

namespace Craft\DDD\Stream\Infrastructure\Repository;

use Bitrix\Main\DB\SqlQueryException;
use Bitrix\Main\Diag\Debug;
use Craft\DDD\Stream\Domain\Entity\ChatMemberEntity;
use Craft\DDD\Stream\Domain\Repository\MemberRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatMemberTable;
use Craft\DDD\Stream\Infrastructure\Entity\ChatTable;
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
	 * @param int $userId1
	 * @param int $userId2
	 * @return int|null
	 * @throws SqlQueryException
	 */
	public function findChatBetweenUsers(int $userId1, int $userId2): ?int
	{
		$sql = sprintf("SELECT 
    c." . ChatTable::F_ID . "
FROM craft_chat c
INNER JOIN craft_chat_member cp1 ON c." . ChatTable::F_ID . " = cp1." . ChatMemberTable::F_CHAT_ID . "
INNER JOIN craft_chat_member cp2 ON c." . ChatTable::F_ID . " = cp2." . ChatMemberTable::F_CHAT_ID . "
WHERE cp1." . ChatMemberTable::F_USER_ID . " = %s
  AND cp2." . ChatMemberTable::F_USER_ID . " = %s
  AND (
    SELECT COUNT(*) 
    FROM craft_chat_member cp3 
    WHERE cp3." . ChatMemberTable::F_CHAT_ID . " = c." . ChatTable::F_ID . "
  ) = 2;",
			$userId1,
			$userId2
		);

		global $DB;

		$result = $DB->Query($sql)->Fetch();

		if($result['ID'])
		{
			return intval($result['ID']);
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