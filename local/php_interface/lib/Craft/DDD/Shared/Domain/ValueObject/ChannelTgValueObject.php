<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class ChannelTgValueObject
{
	public function __construct(
		protected ?string $tgId = null,
	)
	{
		$this->validate();
	}

	protected function validate()
	{

	}

	public function getTgId(): ?string
	{
		return $this->tgId;
	}
}