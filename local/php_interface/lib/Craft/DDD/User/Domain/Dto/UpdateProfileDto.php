<?php

namespace Craft\DDD\User\Domain\Dto;

class UpdateProfileDto
{
	public function __construct(
		protected ?string $name,
		protected ?string $secondName,
		protected ?string $lastName,
		protected ?string $ufBankName,
		protected ?string $ufInn,
		protected ?string $ufKpp,
		protected ?string $ufBik,
		protected ?string $ufOgrn,
		protected ?string $ufCurrAcc,
		protected ?string $ufCorrAcc,
		protected ?string $ufLegalAddress,
		protected ?string $ufPostalAddress,
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

	public function getUfBik(): ?string
	{
		return $this->ufBik;
	}

	public function getUfCorrAcc(): ?string
	{
		return $this->ufCorrAcc;
	}

	public function getUfCurrAcc(): ?string
	{
		return $this->ufCurrAcc;
	}

	public function getUfInn(): ?string
	{
		return $this->ufInn;
	}

	public function getUfKpp(): ?string
	{
		return $this->ufKpp;
	}

	public function getUfLegalAddress(): ?string
	{
		return $this->ufLegalAddress;
	}

	public function getUfOgrn(): ?string
	{
		return $this->ufOgrn;
	}

	public function getUfPostalAddress(): ?string
	{
		return $this->ufPostalAddress;
	}

	public function getSecondName(): ?string
	{
		return $this->secondName;
	}

	public function getUfBankName(): ?string
	{
		return $this->ufBankName;
	}
}