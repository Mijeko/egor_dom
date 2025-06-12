<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\User\Application\Dto\ProfileUpdateServiceDto;
use Craft\DDD\User\Domain\Dto\UpdateProfileDto;
use Craft\DDD\User\Domain\Entity\Profile;
use Craft\DDD\User\Domain\Repository\ProfileRepositoryInterface;

class UpdateProfileService
{

	public function __construct(
		protected ProfileRepositoryInterface $profileRepository
	)
	{
	}

	public function execute(int $profileId, ProfileUpdateServiceDto $profileUpdateServiceDto): ?Profile
	{
		$profile = $this->profileRepository->findById($profileId);
		if(!$profile)
		{
			throw new \Exception("Profile not found");
		}

		$profile->updateProfile(new UpdateProfileDto(
			$profileUpdateServiceDto->getName(),
			$profileUpdateServiceDto->getSecondName(),
			$profileUpdateServiceDto->getLastName(),
			$profileUpdateServiceDto->getInn(),
			$profileUpdateServiceDto->getKpp(),
			$profileUpdateServiceDto->getBik(),
			$profileUpdateServiceDto->getOgrn(),
			$profileUpdateServiceDto->getCurrAcc(),
			$profileUpdateServiceDto->getCorrAcc(),
			$profileUpdateServiceDto->getLegalAddress(),
			$profileUpdateServiceDto->getPostalAddress(),
		));

		return $this->profileRepository->update($profile);
	}
}