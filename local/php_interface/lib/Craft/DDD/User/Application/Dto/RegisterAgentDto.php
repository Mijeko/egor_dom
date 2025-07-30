<?php

namespace Craft\DDD\User\Application\Dto;

final class RegisterAgentDto
{
	public function __construct(
		public string $phone,
		public string $email,
		public string $password,
		public string $inn,
		public string $kpp,
		public string $ogrn,
		public string $bik,
		public string $currAcc,
		public string $corrAcc,
		public string $postAddress,
		public string $legalAddress,
		public string $bankName,
	)
	{
	}
}