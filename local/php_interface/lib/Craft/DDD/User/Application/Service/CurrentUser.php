<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\User\Application\Contract\CurrentUserProviderInterface;
use Craft\DDD\User\Application\Dto\CurrentUserDto;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;

class CurrentUser
{
	public function __construct(
		private CurrentUserProviderInterface $provider,
		private UserRepositoryInterface      $userRepository,
	)
	{
	}

	public function get(): ?CurrentUserDto
	{
		$user = $this->userRepository->findById($this->provider->getUserId());
		if(!$user)
		{
			return null;
		}

		return new CurrentUserDto(
			$user->getId(),
			$user->getEmail()->getValue(),
		);
	}

}