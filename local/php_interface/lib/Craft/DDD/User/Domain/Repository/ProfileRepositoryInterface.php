<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\Profile;

interface ProfileRepositoryInterface
{
	public function findById(int $profileId): ?Profile;

	public function update(Profile $profile): Profile;
}