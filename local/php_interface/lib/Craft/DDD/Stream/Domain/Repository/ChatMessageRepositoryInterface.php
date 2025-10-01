<?php

namespace Craft\DDD\Stream\Domain\Repository;

use Craft\DDD\Stream\Domain\Entity\ChatMessageEntity;
use Craft\Helper\Criteria;

interface ChatMessageRepositoryInterface
{
	public function create(ChatMessageEntity $chatMessage): ?ChatMessageEntity;

	public function findAll(Criteria $criteria = null): array;
}