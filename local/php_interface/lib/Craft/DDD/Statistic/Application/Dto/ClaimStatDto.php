<?php

namespace Craft\DDD\Statistic\Application\Dto;

class ClaimStatDto
{
	public function __construct(
		public string $amountReward,
		public int    $claimTotal,
		public int    $moneyRotate,
		public int    $acceptTake,
	)
	{
	}
}