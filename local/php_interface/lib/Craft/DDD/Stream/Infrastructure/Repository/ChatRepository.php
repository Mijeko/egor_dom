<?php

namespace Craft\DDD\Stream\Infrastructure\Repository;

use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;
use Craft\DDD\Stream\Domain\Entity\ChatEntity;
use Craft\DDD\Stream\Domain\Repository\ChatRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatTable;
use Craft\DDD\Stream\Infrastructure\Entity\EO_Chat;
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
			ChatTable::F_USER_ID        => $userId,
			ChatTable::F_ACCEPT_USER_ID => $acceptUserId,
		]));

		if(count($chats) !== 1)
		{
			return null;
		}

		return array_shift($chats);
	}

	public function findAll(Criteria $criteria = null): array
	{
		$result = [];

		$models = ChatTable::getList($criteria ? $criteria->makeGetListParams() : [])
			->fetchCollection();

		foreach($models as $model)
		{
			$result[] = $this->hydrate($model);
		}

		return $result;
	}

	public function createChat(ChatEntity $chat): ?ChatEntity
	{
		$model = ChatTable::createObject();
		$model->setUserId($chat->getUserId());
		$model->setAcceptUserId($chat->getAcceptUserId());
		$model->setActive($chat->getActive()->getValue());

		$result = $model->save();

		if($result->isSuccess())
		{
			$chat->refreshId($model->getId());
			return $chat;
		}

		return null;
	}

	private function hydrate(EO_Chat $chat): ChatEntity
	{
		return ChatEntity::hydrate(
			$chat->getId(),
			new ActiveValueObject($chat->getActive()),
			$chat->getUserId(),
			$chat->getAcceptUserId()
		);
	}
}