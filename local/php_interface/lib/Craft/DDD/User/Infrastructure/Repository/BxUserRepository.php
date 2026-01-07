<?php

namespace Craft\DDD\User\Infrastructure\Repository;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
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
					'*',
					CraftUserTable::F_PASSWORD,
				])
				->makeGetListParams()
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
		$users = $this->findAll(Criteria::instance()->filter([
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
		$users = $this->findAll(Criteria::instance()->filter([
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
		return UserEntity::hydrate(
			$bxUser->getId(),
			$bxUser->getLogin(),
			$bxUser->getName(),
			$bxUser->getLastName(),
			$bxUser->getSecondName(),
			$bxUser->getPersonalPhoto(),
			new PhoneValueObject($bxUser->getPersonalMobile()),
			new EmailValueObject($bxUser->getEmail()),
			new PasswordValueObject($bxUser->getPassword()),
			$bxUser->fillGroups()->getGroupIdList()
		);
	}

	public function create(UserEntity $entity): ?UserEntity
	{
		return null;
	}
}