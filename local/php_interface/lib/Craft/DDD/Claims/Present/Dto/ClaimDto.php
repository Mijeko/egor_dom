<?php

namespace Craft\DDD\Claims\Present\Dto;

class ClaimDto
{
	public function __construct(
		public int    $id,
		public string $name,
	)
	{
	}
}