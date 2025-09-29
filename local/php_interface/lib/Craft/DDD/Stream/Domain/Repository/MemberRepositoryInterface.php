<?php

namespace Craft\DDD\Stream\Domain\Repository;

use Craft\Helper\Criteria;

interface MemberRepositoryInterface
{
	public function findAll(Criteria $criteria = null): array;
}