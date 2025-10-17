<?php

namespace Craft\DDD\Developers\Application\UseCase;

use Craft\DDD\Developers\Application\Dto\DeveloperSettingsUpdateDto;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject\FeedListValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ChannelEmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ChannelTgValueObject;
use Exception;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject\MaxReservHourValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject\TimeToPaymentsValueObject;

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
			throw new Exception("Developer with ID {$paramsDto->developerId} not found");
		}

		$currentSettingsValueObject = $developer->getSettings();

		$leadChannelList = $paramsDto->channelLead ? array_map(function(string $key) use ($paramsDto) {

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

		}, $paramsDto->channelLead) : $currentSettingsValueObject->getLeadChannelList();
		$feedList = $paramsDto->feedList ? array_map(function(string $link) {
			return new FeedListValueObject($link);
		}, $paramsDto->feedList) : $currentSettingsValueObject->getFeedList();
		$maxReservHours = $paramsDto->maxReservHours ? new MaxReservHourValueObject($paramsDto->maxReservHours) : $currentSettingsValueObject->getMaxReservHours();
		$timeToPayments = $paramsDto->timeToPayments ? new TimeToPaymentsValueObject($paramsDto->timeToPayments) : $currentSettingsValueObject->getTimeToPayments();


		$newSettingsValueObject = new DeveloperSettingsValueObject(
			$leadChannelList,
			$feedList,
			$maxReservHours,
			$timeToPayments,
		);
		

		$developer->updateSettings($newSettingsValueObject);

		$developer = $this->developerRepository->update($developer);
	}
}