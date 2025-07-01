<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class ImportScheduleValueObject
{
	public function __construct(
		protected array     $days,
		protected \DateTime $startAt,
		protected \DateTime $endAt,
	)
	{
	}

	public function getDays(): array
	{
		return $this->days;
	}

	public function getEndAt(): \DateTime
	{
		return $this->endAt;
	}

	public function getStartAt(): \DateTime
	{
		return $this->startAt;
	}
}