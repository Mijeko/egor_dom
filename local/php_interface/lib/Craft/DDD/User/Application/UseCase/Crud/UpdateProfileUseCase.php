<?php

namespace Craft\DDD\User\Application\UseCase\Crud;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\User\Application\Dto\ProfileUpdateServiceDto;
use Craft\DDD\User\Domain\Entity\ProfileEntity;
use Craft\DDD\User\Domain\Repository\ProfileRepositoryInterface;

class UpdateProfileUseCase
{

	public function __construct(
		protected ProfileRepositoryInterface $profileRepository
	)
	{
	}

	public function execute(int $profileId, ProfileUpdateServiceDto $profileUpdateServiceDto): ?ProfileEntity
	{
		$profile = $this->profileRepository->findById($profileId);
		if(!$profile)
		{
			throw new \Exception("Профиль не найден");
		}

		$profile->updateProfile($profileUpdateServiceDto);

		return $this->profileRepository->update($profile);
	}
}