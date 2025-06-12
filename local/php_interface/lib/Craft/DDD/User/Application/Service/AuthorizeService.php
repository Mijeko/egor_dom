<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\User\Application\Service\Interfaces\AutenficatorInterface;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;

class AuthorizeService
{


	public function __construct(
		protected UserRepositoryInterface $repository,
		protected AutenficatorInterface   $autenficator,
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


		return $this->autenficator->loginById($user->getId());
	}
}