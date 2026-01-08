<?php

namespace Craft\DDD\Referal\Application\Dto;

class InviteDto
{
	public function __construct(
		public string $phone,
		public string $code,
	)
	{
	}
}