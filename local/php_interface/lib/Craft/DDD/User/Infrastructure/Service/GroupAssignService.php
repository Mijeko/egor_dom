<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Craft\DDD\User\Application\Contract\GroupAssignInterface;

class GroupAssignService implements GroupAssignInterface
{
	public function assign(array $groupId, int $userId): void
	{
		$model = new \CUser();
		$model->Update($userId, [
			'GROUP_ID' => $groupId,
		]);
	}
}