<?php

namespace Craft\DDD\Developers\Application\Dto;

final class DeveloperSettingsUpdateDto
{
	public function __construct(
		public int    $developerId,
		public ?array $sources = null,
		public ?int   $timeoutBron = null,
		public ?int   $timePay = null,
		public ?array $channelLead = null,
	)
	{
	}
}