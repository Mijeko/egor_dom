<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\User\Domain\Entity\ProfileEntity;

interface ProfileRepositoryInterface
{
	public function findById(int $profileId): ?ProfileEntity;

	public function update(ProfileEntity $profile): ProfileEntity;
}