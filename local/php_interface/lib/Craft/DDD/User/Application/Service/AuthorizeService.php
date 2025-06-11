<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;

class AuthorizeService
{


	public function __construct(
		protected UserRepositoryInterface $repository,
	)
	{
	}

	public function execute(string $phone, string $password): bool
	{
		$user = $this->repository->findByPhoneNumber($phone);
		if(!$user)
		{
			throw new \Exception('User not found');
		}

		if(!$user->validatePassword($password))
		{
			throw new \Exception('Wrong password');
		}

		global $USER;
		return $USER->Authorize($user->getId(), true);
	}
}