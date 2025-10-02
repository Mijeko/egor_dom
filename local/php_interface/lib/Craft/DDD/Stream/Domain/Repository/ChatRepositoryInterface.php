<?php

namespace Craft\DDD\Stream\Domain\Repository;

use Craft\DDD\Stream\Domain\Entity\ChatEntity;
use Craft\Helper\Criteria;

interface ChatRepositoryInterface
{
	public function create(ChatEntity $chat): ?ChatEntity;

	public function findChatById(int $id): ?ChatEntity;

	public function findChatByUsers(int $userId, int $acceptUserId): ?ChatEntity;

	public function findAll(Criteria $criteria = null): array;
}