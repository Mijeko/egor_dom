<?php

namespace Craft\DDD\User\Application\Dto;

use Craft\Core\Helper\DtoManager;

class ProfileUpdateServiceDto extends DtoManager
{
	protected ?string $name = null;
	protected ?string $secondName = null;
	protected ?string $lastName = null;
	protected ?string $ufBankName = null;
	protected ?int $ufInn = null;
	protected ?int $ufKpp = null;
	protected ?int $ufBik = null;
	protected ?int $ufOgrn = null;
	protected ?int $ufCurrAcc = null;
	protected ?int $ufCorrAcc = null;
	protected ?string $ufLegalAddress = null;
	protected ?string $ufPostalAddress = null;

	public function __construct()
	{
	}

	public function setUfBankName(?string $ufBankName): void
	{
		$this->ufBankName = $ufBankName;
	}

	public function getUfBankName(): ?string
	{
		return $this->ufBankName;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function getUfBik(): ?int
	{
		return $this->ufBik;
	}

	public function getUfCorrAcc(): ?int
	{
		return $this->ufCorrAcc;
	}

	public function getUfCurrAcc(): ?int
	{
		return $this->ufCurrAcc;
	}

	public function getUfInn(): ?int
	{
		return $this->ufInn;
	}

	public function getUfKpp(): ?int
	{
		return $this->ufKpp;
	}

	public function getUfLegalAddress(): ?string
	{
		return $this->ufLegalAddress;
	}

	public function getUfOgrn(): ?int
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

	public function setName(?string $name): void
	{
		$this->name = $name;
	}

	public function setLastName(?string $lastName): void
	{
		$this->lastName = $lastName;
	}

	public function setUfBik(?string $ufBik): void
	{
		$this->ufBik = $ufBik;
	}

	public function setUfCorrAcc(?int $ufCorrAcc): void
	{
		$this->ufCorrAcc = $ufCorrAcc;
	}


	public function setUfCurrAcc(?int $ufCurrAcc): void
	{
		$this->ufCurrAcc = $ufCurrAcc;
	}

	public function setUfInn(?int $ufInn): void
	{
		$this->ufInn = $ufInn;
	}

	public function setUfKpp(?int $ufKpp): void
	{
		$this->ufKpp = $ufKpp;
	}


	public function setUfLegalAddress(?string $ufLegalAddress): void
	{
		$this->ufLegalAddress = $ufLegalAddress;
	}

	public function setUfOgrn(?int $ufOgrn): void
	{
		$this->ufOgrn = $ufOgrn;
	}

	public function setUfPostalAddress(?string $ufPostalAddress): void
	{
		$this->ufPostalAddress = $ufPostalAddress;
	}

	public function setSecondName(?string $secondName): void
	{
		$this->secondName = $secondName;
	}
}