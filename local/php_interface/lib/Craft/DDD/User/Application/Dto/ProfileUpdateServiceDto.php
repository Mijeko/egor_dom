<?php

namespace Craft\DDD\User\Application\Dto;

use Craft\Core\Helper\DtoManager;

class ProfileUpdateServiceDto extends DtoManager
{
	protected ?string $name = null;
	protected ?string $secondName = null;
	protected ?string $lastName = null;
	protected ?string $inn = null;
	protected ?string $kpp = null;
	protected ?string $bik = null;
	protected ?string $ogrn = null;
	protected ?string $currAcc = null;
	protected ?string $corrAcc = null;
	protected ?string $legalAddress = null;
	protected ?string $postalAddress = null;

	public function __construct()
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

	public function setName(?string $name): void
	{
		$this->name = $name;
	}

	public function setLastName(?string $lastName): void
	{
		$this->lastName = $lastName;
	}

	public function setBik(?string $bik): void
	{
		$this->bik = $bik;
	}

	public function setCorrAcc(?string $corrAcc): void
	{
		$this->corrAcc = $corrAcc;
	}


	public function setCurrAcc(?string $currAcc): void
	{
		$this->currAcc = $currAcc;
	}

	public function setInn(?string $inn): void
	{
		$this->inn = $inn;
	}

	public function setKpp(?string $kpp): void
	{
		$this->kpp = $kpp;
	}


	public function setLegalAddress(?string $legalAddress): void
	{
		$this->legalAddress = $legalAddress;
	}

	public function setOgrn(?string $ogrn): void
	{
		$this->ogrn = $ogrn;
	}

	public function setPostalAddress(?string $postalAddress): void
	{
		$this->postalAddress = $postalAddress;
	}

	public function setSecondName(?string $secondName): void
	{
		$this->secondName = $secondName;
	}
}