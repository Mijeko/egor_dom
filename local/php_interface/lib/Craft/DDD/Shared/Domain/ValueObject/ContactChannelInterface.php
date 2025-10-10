<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

interface ContactChannelInterface
{
	public function isEnabled(): bool;
}