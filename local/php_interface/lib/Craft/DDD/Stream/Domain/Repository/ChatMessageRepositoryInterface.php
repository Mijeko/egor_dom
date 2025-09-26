<?php

namespace Craft\DDD\Stream\Domain\Repository;

use Craft\DDD\Stream\Domain\Entity\MessageEntity;
use Craft\Helper\Criteria;

interface ChatMessageRepositoryInterface
{
	public function create(MessageEntity $chatMessage): ?MessageEntity;

	public function findAll(Criteria $criteria = null): array;
}