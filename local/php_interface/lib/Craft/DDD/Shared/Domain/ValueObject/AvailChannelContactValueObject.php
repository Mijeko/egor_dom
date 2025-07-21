<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class AvailChannelContactValueObject
{
	public function __construct(
		protected ?ChannelEmailValueObject $channelEmail = null,
		protected ?ChannelTgValueObject    $channelTg = null,
	)
	{
	}


	public function fromJson(string $json): static
	{
		return new static();
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