<?php

namespace Craft\DDD\Claims\Present\Dto;

class ClaimDetailDto
{
	public function __construct(
		public ClaimDto     $claim,
	)
	{
	}
}