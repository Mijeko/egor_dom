<?php

namespace Craft\DDD\User\Domain\Entity;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\User\Application\Dto\ProfileUpdateServiceDto;

class ProfileEntity
{
	public function __construct(
		protected ?int    $id,
		protected ?string $name,
		protected ?string $secondName,
		protected ?string $lastName,
		protected ?string $bank,
		protected ?string $inn,
		protected ?string $kpp,
		protected ?string $bik,
		protected ?string $ogrn,
		protected ?string $currAcc,
		protected ?string $corrAcc,
		protected ?string $legalAddress,
		protected ?string $postalAddress,
	)
	{
	}

	public function updateProfile(ProfileUpdateServiceDto $profileDto): void
	{
		$this->name = $profileDto->name;
		$this->secondName = $profileDto->secondName;
		$this->lastName = $profileDto->lastName;
		$this->bank = $profileDto->ufBankName;
		$this->inn = $profileDto->ufInn;
		$this->kpp = $profileDto->ufKpp;
		$this->bik = $profileDto->ufBik;
		$this->ogrn = $profileDto->ufOgrn;
		$this->currAcc = $profileDto->ufCurrAcc;
		$this->corrAcc = $profileDto->ufCorrAcc;
		$this->legalAddress = $profileDto->ufLegalAddress;
		$this->postalAddress = $profileDto->ufPostalAddress;
	}


	public function getBank(): ?string
	{
		return $this->bank;
	}

	public function getSecondName(): ?string
	{
		return $this->secondName;
	}

	public function getPostalAddress(): ?string
	{
		return $this->postalAddress;
	}

	public function getOgrn(): ?int
	{
		return $this->ogrn;
	}

	public function getLegalAddress(): ?string
	{
		return $this->legalAddress;
	}

	public function getKpp(): ?string
	{
		return $this->kpp;
	}

	public function getInn(): ?string
	{
		return $this->inn;
	}

	public function getCurrAcc(): ?string
	{
		return $this->currAcc;
	}

	public function getCorrAcc(): ?string
	{
		return $this->corrAcc;
	}

	public function getBik(): ?string
	{
		return $this->bik;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getId(): ?int
	{
		return $this->id;
	}
}