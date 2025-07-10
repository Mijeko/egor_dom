<?php

namespace Craft\Dto;

use Bitrix\Main\Diag\Debug;
use Craft\Model\CraftUser;

class BxUserDto
{


	public function __construct(
		public int     $id,
		public string  $name,
		public string  $lastName,
		public string  $secondName,
		public string  $fullName,
		public string  $email,
		public ?string $inn = null,
		public ?string $ogrn = null,
		public ?string $kpp = null,
		public ?string $bik = null,
		public ?string $currAccount = null,
		public ?string $corrAccount = null,
		public ?string $legalAddress = null,
		public ?string $postAddress = null,
		public ?string $bankName = null,
	)
	{
	}

	public static function fromGlobal(): ?static
	{

		$user = CraftUser::load();
		if(!$user || !$user->IsAuthorized())
		{
			return null;
		}

		return new static(
			(int)$user->getId(),
			$user->getName(),
			$user->getLastName(),
			$user->getSecondName(),
			$user->getFullName(),
			$user->getEmail(),
			$user->fillUfInn(),
			$user->fillUfOgrn(),
			$user->fillUfKpp(),
			$user->fillUfBik(),
			$user->fillUfCurrAcc(),
			$user->fillUfCorrAcc(),
			$user->fillUfLegalAddress(),
			$user->fillUfPostAddress(),
			$user->fillUfBankName(),
		);
	}
}