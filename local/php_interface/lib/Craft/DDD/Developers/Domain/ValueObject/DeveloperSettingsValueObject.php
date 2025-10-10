<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

use Craft\DDD\Shared\Domain\ValueObject\ContactChannelInterface;

class DeveloperSettingsValueObject
{

	public function __construct(
		private ?array $leadChannelList = null,
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
	}

	/**
	 * @return array<int, ContactChannelInterface>|null
	 */
	public function getLeadChannelList(): ?array
	{
		return $this->leadChannelList;
	}

}