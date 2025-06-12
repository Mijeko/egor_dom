<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\User\Domain\Dto\UpdateProfileDto;

class Profile
{
	public function __construct(
		protected ?int    $id,
		protected ?string $name,
		protected ?string $secondName,
		protected ?string $lastName,
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

	public function updateProfile(UpdateProfileDto $profileDto): void
	{
		$this->name = $profileDto->getName();
		$this->secondName = $profileDto->getSecondName();
		$this->lastName = $profileDto->getLastName();
		$this->inn = $profileDto->getInn();
		$this->kpp = $profileDto->getKpp();
		$this->bik = $profileDto->getBik();
		$this->ogrn = $profileDto->getOgrn();
		$this->currAcc = $profileDto->getCurrAcc();
		$this->corrAcc = $profileDto->getCorrAcc();
		$this->legalAddress = $profileDto->getLegalAddress();
		$this->postalAddress = $profileDto->getPostalAddress();
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