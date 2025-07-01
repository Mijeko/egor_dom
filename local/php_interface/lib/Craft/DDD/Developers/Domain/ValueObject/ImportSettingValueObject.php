<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class ImportSettingValueObject
{
	public function __construct(
		protected ?string                    $handler,
		protected ?string                    $sourceLink,
		protected ?ImportScheduleValueObject $schedule,
	)
	{
	}

	public function getHandler(): ?string
	{
		return $this->handler;
	}

	public function getSchedule(): ?ImportScheduleValueObject
	{
		return $this->schedule;
	}

	public function getSourceLink(): ?string
	{
		return $this->sourceLink;
	}
}