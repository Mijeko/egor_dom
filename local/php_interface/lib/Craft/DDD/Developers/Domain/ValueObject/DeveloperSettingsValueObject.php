<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject\FeedListValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ContactChannelInterface;

class DeveloperSettingsValueObject
{

	public function __construct(
		private ?array $leadChannelList = null,
		private ?array $feedList = [],
		private ?int   $maxReservHours = 0,
		private ?int   $timeToPayments = 0,
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

	/**
	 * @return array<int, ContactChannelInterface>|null
	 */
	public function getLeadChannelList(): ?array
	{
		return $this->leadChannelList;
	}

	/**
	 * @return array<int, FeedListValueObject>|null
	 */
	public function getFeedList(): ?array
	{
		return $this->feedList;
	}

}