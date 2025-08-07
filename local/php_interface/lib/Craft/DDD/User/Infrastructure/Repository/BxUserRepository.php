<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\UserEntity;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\Helper\Criteria;
use Craft\Model\CraftUser;
use Craft\Model\CraftUserTable;

class BxUserRepository implements UserRepositoryInterface
{

	public function findAll(Criteria $criteria): array
	{
		$result = [];
		$userList = CraftUserTable::getList(
			$criteria
				->useSecureFields()
				->select([
					CraftUserTable::F_ID,
					CraftUserTable::F_LOGIN,
					CraftUserTable::F_EMAIL,
					CraftUserTable::F_PERSONAL_PHONE,
					CraftUserTable::F_PERSONAL_MOBILE,
					CraftUserTable::F_PASSWORD,
				])
				->construct()
		)
			->fetchCollection();

		foreach($userList as $user)
		{
			$result[] = $this->hydrateElement($user);
		}

		return $result;

	}

	public function findById(int $id): ?UserEntity
	{
		$users = $this->findAll(Criteria::build()->filter([
			CraftUserTable::F_ID => $id,
		]));

		if(count($users) != 1)
		{
			return null;
		}

		return array_shift($users);
	}

	public function findByPhoneNumber(PhoneValueObject $phoneNumber): ?UserEntity
	{
		$users = $this->findAll(Criteria::build()->filter([
			CraftUserTable::F_PERSONAL_MOBILE => $phoneNumber->getValue(),
		]));

		if(count($users) != 1)
		{
			return null;
		}

		return array_shift($users);
	}

	public function hydrateElement(CraftUser $bxUser): UserEntity
	{
		$user = new UserEntity(
			$bxUser->getId(),
			$bxUser->getLogin(),
			$bxUser->getPersonalMobile(),
			$bxUser->getEmail(),
			$bxUser->getPassword(),
		);

		return $user;
	}
}