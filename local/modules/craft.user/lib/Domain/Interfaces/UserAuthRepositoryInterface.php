<?php

namespace Craft\User\Domain\Interfaces;

use Craft\User\Application\Entity\JUser;

interface UserAuthRepositoryInterface
{
	public function exists(string $phone): bool;

	public function create(JUser $user, string $phone): bool;
}