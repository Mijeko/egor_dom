<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\BikValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\KppValueObject;
use Craft\DDD\Shared\Domain\ValueObject\OgrnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class AgentEntity
{

	public function __construct(
		protected ?int                   $id,
		protected ?string                $name,
		protected ?string                $lastName,
		protected ?string                $secondName,
		protected PhoneValueObject       $phone,
		protected EmailValueObject       $email,
		protected ?PasswordValueObject   $password = null,
		protected InnValueObject         $inn,
		protected KppValueObject         $kpp,
		protected OgrnValueObject        $ogrn,
		protected BikValueObject         $bik,
		protected CurrAccountValueObject $currAcc,
		protected CorrAccountValueObject $corrAcc,
		protected string                 $postAddress,
		protected string                 $legalAddress,
		protected string                 $bankName,
		protected ?int                   $personalManagerId = null
	)
	{
	}

	public static function register(
		PhoneValueObject       $phone,
		EmailValueObject       $email,
		PasswordValueObject    $password,
		InnValueObject         $inn,
		KppValueObject         $kpp,
		OgrnValueObject        $ogrn,
		BikValueObject         $bik,
		CurrAccountValueObject $currAcc,
		CorrAccountValueObject $corrAcc,
		string                 $postAddress,
		string                 $legalAddress,
		string                 $bankName,
	): static
	{
		return new static(
			null,
			null,
			null,
			null,
			$phone,
			$email,
			$password,
			$inn,
			$kpp,
			$ogrn,
			$bik,
			$currAcc,
			$corrAcc,
			$postAddress,
			$legalAddress,
			$bankName,
		);
	}

	public function assignManager(ManagerEntity $manager): static
	{
		$this->personalManagerId = $manager->getId();
		return $this;
	}

	public function refreshIdAfterRegister(int $id): static
	{
		$this->id = $id;
		return $this;
	}

	public function getBik(): BikValueObject
	{
		return $this->bik;
	}

	public function getCorrAcc(): CorrAccountValueObject
	{
		return $this->corrAcc;
	}

	public function getCurrAcc(): CurrAccountValueObject
	{
		return $this->currAcc;
	}

	public function getInn(): InnValueObject
	{
		return $this->inn;
	}

	public function getKpp(): KppValueObject
	{
		return $this->kpp;
	}

	public function getOgrn(): OgrnValueObject
	{
		return $this->ogrn;
	}

	public function getPostAddress(): string
	{
		return $this->postAddress;
	}

	public function getLegalAddress(): string
	{
		return $this->legalAddress;
	}

	public function getBankName(): string
	{
		return $this->bankName;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getPhone(): PhoneValueObject
	{
		return $this->phone;
	}

	public function getPassword(): ?PasswordValueObject
	{
		return $this->password;
	}

	public function getEmail(): EmailValueObject
	{
		return $this->email;
	}

	public function getPersonalManagerId(): ?int
	{
		return $this->personalManagerId;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function getSecondName(): ?string
	{
		return $this->secondName;
	}
}