<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\User\Domain\Entity\Profile;
use Craft\DDD\User\Domain\Repository\ProfileRepositoryInterface;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;

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
			$user->getUfBankName(),
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

		$updateParams = [
			CraftUserTable::F_NAME             => $profile->getName(),
			CraftUserTable::F_LAST_NAME        => $profile->getLastName(),
			CraftUserTable::F_SECOND_NAME      => $profile->getSecondName(),
			CraftUserTable::UF_BANK_NAME       => $profile->getBank(),
			CraftUserTable::F_UF_INN           => $profile->getInn(),
			CraftUserTable::F_UF_OGRN          => $profile->getOgrn(),
			CraftUserTable::F_UF_BIK           => $profile->getBik(),
			CraftUserTable::F_UF_KPP           => $profile->getKpp(),
			CraftUserTable::F_UF_CURR_ACC      => $profile->getCurrAcc(),
			CraftUserTable::F_UF_CORR_ACC      => $profile->getCorrAcc(),
			CraftUserTable::F_UF_LEGAL_ADDRESS => $profile->getLegalAddress(),
			CraftUserTable::F_UF_POST_ADDRESS  => $profile->getPostalAddress(),
		];

		Debug::dumpToFile($updateParams);

		$model = new \CUser();
		$result = $model->Update(
			$user->getId(),
			$updateParams
		);

		if(!$result)
		{
			throw new \Exception('Failed to update profile: ' . $model->LAST_ERROR);
		}

		return $profile;
	}
}