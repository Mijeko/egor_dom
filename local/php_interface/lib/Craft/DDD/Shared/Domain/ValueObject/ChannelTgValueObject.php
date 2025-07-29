<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

final class ChannelTgValueObject
{
	public function __construct(
		protected ?string $enable,
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

	public function isEnabled(): ?bool
	{
		return true;
	}
}