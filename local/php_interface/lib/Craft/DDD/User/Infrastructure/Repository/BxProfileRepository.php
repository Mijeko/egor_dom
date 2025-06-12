<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\User\Domain\Entity\Profile;
use Craft\DDD\User\Domain\Repository\ProfileRepositoryInterface;
use Craft\Model\CraftUser;

class BxProfileRepository implements ProfileRepositoryInterface
{

	public function findById(int $profileId): Profile
	{
		$user = CraftUser::load($profileId);
		if(!$user)
		{
			throw new \Exception('Profile not found');
		}

		return new Profile(
			$user->getId(),
			$user->getName(),
			$user->getSecondName(),
			$user->getLastName(),
			$user->getUfInn(),
			$user->getUfKpp(),
			$user->getUfBik(),
			$user->getUfOgrn(),
			$user->getUfCurrAcc(),
			$user->getUfCorrAcc(),
			$user->getUfLegalAddress(),
			$user->getUfPostAddress()
		);
	}

	public function update(Profile $profile): Profile
	{

		$user = CraftUser::load($profile->getId());
		if(!$user)
		{
			throw new \Exception('Profile not found');
		}

		$user->setName($profile->getName());
		$user->setSecondName($profile->getSecondName());
		$user->setLastName($profile->getLastName());
		$user->setUfInn($profile->getInn());
		$user->setUfKpp($profile->getKpp());
		$user->setUfBik($profile->getBik());
		$user->setUfOgrn($profile->getOgrn());
		$user->setUfCurrAcc($profile->getCurrAcc());
		$user->setUfCorrAcc($profile->getCorrAcc());
		$user->setUfLegalAddress($profile->getLegalAddress());
		$user->setUfPostAddress($profile->getPostalAddress());

		$result = $user->save();

		if(!$result->isSuccess())
		{
			throw new \Exception('Failed to update profile');
		}

		return $profile;
	}
}