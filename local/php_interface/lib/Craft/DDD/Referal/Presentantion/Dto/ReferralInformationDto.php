<?php

namespace Craft\DDD\Referal\Presentantion\Dto;

class ReferralInformationDto
{
	public function __construct(
		public ?string $link = null,
		public ?int    $countJoined = null,
		public ?string $reward = null,
	)
	{
	}
}