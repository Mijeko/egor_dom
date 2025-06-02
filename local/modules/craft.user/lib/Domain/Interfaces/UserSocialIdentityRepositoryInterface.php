<?php

namespace Craft\User\Domain\Interfaces;

use Craft\User\Domain\Entity\UserSocialIdentity;

interface UserSocialIdentityRepositoryInterface
{
	public function create(UserSocialIdentity $identity): ?UserSocialIdentity;
}