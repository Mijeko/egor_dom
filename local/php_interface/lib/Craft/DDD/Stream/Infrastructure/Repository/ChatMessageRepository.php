<?php

namespace Craft\DDD\Stream\Infrastructure\Repository;

use Craft\DDD\Stream\Domain\Entity\ChatMessageEntity;
use Craft\DDD\Stream\Domain\Repository\ChatMessageRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatMessageTable;
use Craft\DDD\Stream\Infrastructure\Entity\EO_ChatMessage;
use Craft\Helper\Criteria;

class ChatMessageRepository implements ChatMessageRepositoryInterface
{
	public function create(ChatMessageEntity $chatMessage): ?ChatMessageEntity
	{
		$model = ChatMessageTable::createObject();
		$model->setChatId($chatMessage->getChatId());
		$model->setText($chatMessage->getMessage());
		$model->setAuthorUserId($chatMessage->getUserId());

		$result = $model->save();

		if($result->isSuccess())
		{

			return $chatMessage;
		}

		return null;
	}

	public function findAll(Criteria $criteria = null): array
	{
		$result = [];

		$models = ChatMessageTable::getList($criteria ? $criteria->makeGetListParams() : [])
			->fetchCollection();


		foreach($models as $model)
		{
			$result[] = $this->hydrate($model);
		}

		return $result;
	}

	private function hydrate(EO_ChatMessage $chatMessage): ?ChatMessageEntity
	{
		return ChatMessageEntity::hydrate(
			$chatMessage->getId(),
			$chatMessage->getChatId(),
			$chatMessage->getAuthorUserId(),
			$chatMessage->getText()
		);
	}
}