<?php

namespace Craft\DDD\Claims\Application\Dto;

class ClaimCreateDto
{
	public function __construct(
		public int    $apartmentId,
		public int    $userId,
		public string $email,
		public string $phone,
		public string $client,
		public string $inn,
		public string $kpp,
		public string $bik,
		public string $ogrn,
		public string $currAccount,
		public string $corrAccount,
		public string $legalAddress,
		public string $postAddress,
		public string $bankName,
	)
	{
	}
}