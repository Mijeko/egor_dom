<?php

namespace Craft\DDD\Developers\Application\UseCase;

use Craft\DDD\Developers\Application\Dto\DeveloperSettingsUpdateDto;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;

class DeveloperSettingsUpdateUseCase
{

	public function __construct(
		private DeveloperRepositoryInterface $developerRepository,
	)
	{
	}

	public function execute(DeveloperSettingsUpdateDto $paramsDto): void
	{
		$developer = $this->developerRepository->findById($paramsDto->developerId);
		if(!$developer)
		{
			throw new \Exception("Developer with ID {$paramsDto->developerId} not found");
		}

		$settingsValueObject = $developer->getSettings();


		$developer->updateSettings($settingsValueObject);

		$developer = $this->developerRepository->update($developer);
	}
}