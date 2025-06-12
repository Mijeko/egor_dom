<?php

namespace Craft\DDD\User\Domain\Dto;

class UpdateProfileDto
{
	public function __construct(
		protected ?string $name,
		protected ?string $secondName,
		protected ?string $lastName,
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

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function getBik(): ?string
	{
		return $this->bik;
	}

	public function getCorrAcc(): ?string
	{
		return $this->corrAcc;
	}

	public function getCurrAcc(): ?string
	{
		return $this->currAcc;
	}

	public function getInn(): ?string
	{
		return $this->inn;
	}

	public function getKpp(): ?string
	{
		return $this->kpp;
	}

	public function getLegalAddress(): ?string
	{
		return $this->legalAddress;
	}

	public function getOgrn(): ?string
	{
		return $this->ogrn;
	}

	public function getPostalAddress(): ?string
	{
		return $this->postalAddress;
	}

	public function getSecondName(): ?string
	{
		return $this->secondName;
	}
}