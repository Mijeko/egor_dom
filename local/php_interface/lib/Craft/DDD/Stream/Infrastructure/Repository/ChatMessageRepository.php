<?php

namespace Craft\DDD\Stream\Infrastructure\Repository;

use Craft\DDD\Stream\Domain\Entity\MessageEntity;
use Craft\DDD\Stream\Domain\Repository\ChatMessageRepositoryInterface;
use Craft\Helper\Criteria;

class ChatMessageRepository implements ChatMessageRepositoryInterface
{
	public function create(MessageEntity $chatMessage): ?MessageEntity
	{
		return null;
	}

	public function findAll(Criteria $criteria = null): array
	{
		return [];
	}
}