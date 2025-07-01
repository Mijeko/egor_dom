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
}