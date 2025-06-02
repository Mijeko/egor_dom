<?php

namespace Craft\User\Application\Service;

use Craft\User\Application\Entity\JUser;
use Craft\User\Domain\Dto\UserRegisterDto;
use Craft\User\Domain\Entity\SocialType;
use Craft\User\Domain\Entity\UserSocialIdentity;
use Craft\User\Domain\Interfaces\UserAuthRepositoryInterface;
use Craft\User\Domain\Interfaces\UserRepositoryInterface;
use Craft\User\Domain\Interfaces\UserSocialIdentityRepositoryInterface;

class Register
{
	protected bool $useAuthPhone = false;

	protected UserRepositoryInterface $userRepository;
	protected UserAuthRepositoryInterface $userAuthRepository;
	protected UserSocialIdentityRepositoryInterface $userSocialIdentityRepository;

	public function __construct(
		UserRepositoryInterface               $userRepository,
		UserAuthRepositoryInterface           $userAuthRepository,
		UserSocialIdentityRepositoryInterface $userSocialIdentityRepository
	)
	{
		$this->userRepository = $userRepository;
		$this->userAuthRepository = $userAuthRepository;
		$this->userSocialIdentityRepository = $userSocialIdentityRepository;
	}

	public function usePhone(bool $usePhone): Register
	{
		$this->useAuthPhone = $usePhone;
		return $this;
	}

	public function registerUser(string $email, string $phone, string $password, ?UserRegisterDto $additionalParams = null): JUser
	{
		if($this->exist($phone))
		{
			throw new \Exception('User already exist');
		}

		$user = $this->userRepository->createUser($email, $phone, $password, $additionalParams);

		if(!$user)
		{
			throw new \Exception('User not created');
		}

		if($this->useAuthPhone)
		{
			$this->attachAuthPhone($user, $phone);
		}

		return $user;
	}

	public function exist(string $phone): bool
	{
		return $this->userAuthRepository->exists($phone);
	}

	public function attachAuthPhone(JUser $user, string $phone): bool
	{
		return $this->userAuthRepository->create($user, $phone);
	}

	public function addUserSocial(JUser $user, string $socialId, SocialType $socialType): bool
	{
		$userIdentity = new UserSocialIdentity(
			$user,
			$socialId,
			$socialType
		);

		$result = $this->userSocialIdentityRepository->create($userIdentity);

		return $result instanceof UserSocialIdentity;
	}
}