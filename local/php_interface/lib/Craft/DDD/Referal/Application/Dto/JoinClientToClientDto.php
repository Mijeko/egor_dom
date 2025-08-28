<?php

namespace Craft\DDD\Referal\Application\Dto;

class JoinClientToClientDto
{
	public function __construct(
		public string $phone,
		public string $code,
	)
	{
	}
}