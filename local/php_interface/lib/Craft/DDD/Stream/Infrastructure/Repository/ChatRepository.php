<?php

namespace Craft\DDD\Stream\Infrastructure\Repository;

use Craft\DDD\Stream\Domain\Entity\ChatEntity;
use Craft\DDD\Stream\Domain\Repository\ChatRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatTable;
use Craft\Helper\Criteria;

class ChatRepository implements ChatRepositoryInterface
{

	public function findChatById(int $id): ?ChatEntity
	{
		$chats = $this->findAll(Criteria::instance()->filter([
			ChatTable::F_ID => $id,
		]));

		if(count($chats) !== 1)
		{
			return null;
		}

		return array_shift($chats);
	}

	public function findChatByUsers(int $userId, int $acceptUserId): ?ChatEntity
	{
		$chats = $this->findAll(Criteria::instance()->filter([
			ChatTable::F_USER_ID         => $userId,
			ChatTable::F_ACCPEPT_USER_ID => $acceptUserId,
		]));

		if(count($chats) !== 1)
		{
			return null;
		}

		return array_shift($chats);
	}

	public function findAll(Criteria $criteria = null): array
	{
		return [];
	}
}