<?php

namespace Craft\DDD\Referal\Application\Dto;

class InsertReferralDto
{
	public function __construct(
		public int    $userId,
		public string $phone,
	)
	{
	}
}