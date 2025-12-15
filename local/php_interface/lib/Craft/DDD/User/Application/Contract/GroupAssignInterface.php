<?php

namespace Craft\DDD\User\Application\Contract;

interface GroupAssignInterface
{
	public function assign(array $groupId, int $userId): void;
}