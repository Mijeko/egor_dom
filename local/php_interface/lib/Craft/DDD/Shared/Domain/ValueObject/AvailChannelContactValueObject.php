<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

final class AvailChannelContactValueObject
{
	public function __construct(
		protected ?ChannelEmailValueObject $channelEmail = null,
		protected ?ChannelTgValueObject    $channelTg = null,
	)
	{
	}

	public function getChannelTg(): ?ChannelTgValueObject
	{
		return $this->channelTg;
	}

	public function getChannelEmail(): ?ChannelEmailValueObject
	{
		return $this->channelEmail;
	}
}