<?php

namespace Craft\DDD\User\Application\Dto;

use Craft\Core\Helper\DtoManager;

class ProfileUpdateServiceDto extends DtoManager
{

	public function __construct(
		public ?string $name = null,
		public ?string $secondName = null,
		public ?string $lastName = null,
		public ?string $ufBankName = null,
		public ?string $ufInn = null,
		public ?string $ufKpp = null,
		public ?string $ufBik = null,
		public ?string $ufOgrn = null,
		public ?string $ufCurrAcc = null,
		public ?string $ufCorrAcc = null,
		public ?string $ufLegalAddress = null,
		public ?string $ufPostalAddress = null,
	)
	{
	}
}