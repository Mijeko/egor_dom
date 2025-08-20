<?php

namespace Craft\DDD\Referal\Application\Dto;

class JoinClientToClientDto
{
	public function __construct(
		public int    $inviteUserId,
		public string $phone,
		public string $code,
	)
	{
	}
}