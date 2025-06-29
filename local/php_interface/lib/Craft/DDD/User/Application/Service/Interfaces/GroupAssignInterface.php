<?php

namespace Craft\DDD\User\Application\Service\Interfaces;

interface GroupAssignInterface
{
	public function assign(array $groupId, int $userId): void;
}