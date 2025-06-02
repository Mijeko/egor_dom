<?php

namespace Craft\User\Infrastructure\Repository;

use Craft\User\Application\Entity\JUserSocialIdentityTable;
use Craft\User\Domain\Entity\UserSocialIdentity;
use Craft\User\Domain\Interfaces\UserSocialIdentityRepositoryInterface;

class UserSocialIdentityRepository implements UserSocialIdentityRepositoryInterface
{
	public function create(UserSocialIdentity $identity): ?UserSocialIdentity
	{
		$jUserSocialIdentity = JUserSocialIdentityTable::createObject();
		$jUserSocialIdentity->setSocial($identity->getSocialType()->getName());
		$jUserSocialIdentity->setUserId($identity->getUser()->getId());
		$jUserSocialIdentity->setIdentityId($identity->getSocialId());

		$result = $jUserSocialIdentity->save();
		if($result->isSuccess())
		{
			return $identity;
		}

		throw new \Exception(implode("\n", $result->getErrorMessages()));
	}
}