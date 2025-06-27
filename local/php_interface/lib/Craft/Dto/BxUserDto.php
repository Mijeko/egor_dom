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
		public ?int    $inn = null,
		public ?int    $ogrn = null,
		public ?int    $kpp = null,
		public ?int    $bik = null,
		public ?int    $currAccount = null,
		public ?int    $corrAccount = null,
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
			(int)$user->fillUfInn(),
			(int)$user->fillUfOgrn(),
			(int)$user->fillUfKpp(),
			(int)$user->fillUfBik(),
			(int)$user->fillUfCurrAcc(),
			(int)$user->fillUfCorrAcc(),
			$user->fillUfLegalAddress(),
			$user->fillUfPostAddress(),
			$user->fillUfBankName(),
		);
	}
}