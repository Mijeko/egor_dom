<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\User\Application\Contract\CurrentUserProviderInterface;
use Craft\DDD\User\Application\Dto\CurrentUserDto;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\Dto\BxImageDto;

class CurrentUser
{
	public function __construct(
		private CurrentUserProviderInterface $provider,
		private UserRepositoryInterface      $userRepository,
		private ImageServiceInterface        $imageService,
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

		$avatar = null;

		if($user->getAvatarId())
		{
			$image = $this->imageService->findById($user->getAvatarId());
			if($image)
			{
				$avatar = new BxImageDto(
					$image->id,
					$image->src,
				);
			}
		}

		return new CurrentUserDto(
			$user->getId(),
			$user->getName(),
			$user->getEmail()->getValue(),
			$avatar,
		);
	}

}