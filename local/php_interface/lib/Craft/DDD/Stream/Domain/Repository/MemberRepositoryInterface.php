<?php

namespace Craft\DDD\Stream\Domain\Repository;

use Craft\DDD\Stream\Domain\Entity\ChatMemberEntity;
use Craft\Helper\Criteria;

interface MemberRepositoryInterface
{
	public function findAll(Criteria $criteria = null): array;

	public function create(ChatMemberEntity $member): ?ChatMemberEntity;
}