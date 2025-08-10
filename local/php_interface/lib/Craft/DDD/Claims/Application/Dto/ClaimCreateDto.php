<?php

namespace Craft\DDD\Claims\Application\Dto;

final class ClaimCreateDto
{
	public function __construct(
		public int    $apartmentId,
		public int    $userId,
		public string $email,
		public string $phone,
		public string $client,
	)
	{
	}
}