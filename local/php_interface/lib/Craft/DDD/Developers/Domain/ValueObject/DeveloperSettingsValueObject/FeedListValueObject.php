<?php

namespace Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject;

class FeedListValueObject
{
	public function __construct(
		private ?string $feedSource = null,
	)
	{
	}

	public function getFeedSource(): ?string
	{
		return $this->feedSource;
	}
}