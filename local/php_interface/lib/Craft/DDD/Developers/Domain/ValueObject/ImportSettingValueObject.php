<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class ImportSettingValueObject
{
	public function __construct(
		protected ?string                    $handler,
		protected ?array                     $sourceLink,
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

	/**
	 * @return UrlValueObject[] | null
	 */
	public function getSourceLink(): ?array
	{
		return $this->sourceLink;
	}
}