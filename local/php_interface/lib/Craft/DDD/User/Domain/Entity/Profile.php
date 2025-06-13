<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\User\Application\Dto\ProfileUpdateServiceDto;

class Profile
{
	public function __construct(
		protected ?int    $id,
		protected ?string $name,
		protected ?string $secondName,
		protected ?string $lastName,
		protected ?string $bank,
		protected ?int    $inn,
		protected ?int    $kpp,
		protected ?int    $bik,
		protected ?int    $ogrn,
		protected ?int    $currAcc,
		protected ?int    $corrAcc,
		protected ?string $legalAddress,
		protected ?string $postalAddress,
	)
	{
	}

	public function updateProfile(ProfileUpdateServiceDto $profileDto): void
	{
		$this->name = $profileDto->getName();
		$this->secondName = $profileDto->getSecondName();
		$this->lastName = $profileDto->getLastName();
		$this->bank = $profileDto->getUfBankName();
		$this->inn = $profileDto->getUfInn();
		$this->kpp = $profileDto->getUfKpp();
		$this->bik = $profileDto->getUfBik();
		$this->ogrn = $profileDto->getUfOgrn();
		$this->currAcc = $profileDto->getUfCurrAcc();
		$this->corrAcc = $profileDto->getUfCorrAcc();
		$this->legalAddress = $profileDto->getUfLegalAddress();
		$this->postalAddress = $profileDto->getUfPostalAddress();
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

	public function getKpp(): ?int
	{
		return $this->kpp;
	}

	public function getInn(): ?int
	{
		return $this->inn;
	}

	public function getCurrAcc(): ?int
	{
		return $this->currAcc;
	}

	public function getCorrAcc(): ?int
	{
		return $this->corrAcc;
	}

	public function getBik(): ?int
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