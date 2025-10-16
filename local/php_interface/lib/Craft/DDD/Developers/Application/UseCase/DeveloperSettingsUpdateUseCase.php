<?php

namespace Craft\DDD\Developers\Application\UseCase;

use Craft\DDD\Developers\Application\Dto\DeveloperSettingsUpdateDto;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ChannelEmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ChannelTgValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ContactChannelInterface;

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

		$currentSettingsValueObject = $developer->getSettings();


		$newSettingsValueObject = new DeveloperSettingsValueObject(
			$paramsDto->channelLead ? array_map(function(string $key) use ($paramsDto) {

				switch($key)
				{
					case 'email':
						return new ChannelEmailValueObject(
							'Y',
							$paramsDto->email
						);
					case 'tg':
						return new ChannelTgValueObject(
							'Y',
							$paramsDto->tgId,
						);
						break;
					default:
						return null;
				}

			}, $paramsDto->channelLead) : $currentSettingsValueObject->getLeadChannelList(),
			$paramsDto->feedList ?? null,
			$paramsDto->maxReservHours ?? null,
			$paramsDto->timeToPayments ?? null,
		);

		$developer->updateSettings($newSettingsValueObject);

		$developer = $this->developerRepository->update($developer);
	}
}