<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject\FeedListValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject\MaxReservHourValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject\TimeToPaymentsValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ContactChannelInterface;

class DeveloperSettingsValueObject
{

	public function __construct(
		private ?array                     $leadChannelList = null,
		private ?array                     $feedList = [],
		private ?MaxReservHourValueObject  $maxReservHours = null,
		private ?TimeToPaymentsValueObject $timeToPayments = null,
	)
	{
		$this->validate();
	}

	public function validate(): void
	{
		foreach($this->leadChannelList as $leadChanel)
		{
			if(!$leadChanel instanceof ContactChannelInterface)
			{
				throw new \Exception('');
			}
		}

		foreach($this->feedList as $feed)
		{
			if(!$feed instanceof FeedListValueObject)
			{
				throw new \Exception('');
			}
		}
	}

	public static function fromJson(string $json): DeveloperSettingsValueObject
	{
		$self = new self();

		return $self;
	}

	public function getLeadChannelList(): ?array
	{
		return $this->leadChannelList;
	}

	public function getFeedList(): ?array
	{
		return $this->feedList;
	}

	public function getMaxReservHours(): ?MaxReservHourValueObject
	{
		return $this->maxReservHours;
	}

	public function getTimeToPayments(): ?TimeToPaymentsValueObject
	{
		return $this->timeToPayments;
	}

}