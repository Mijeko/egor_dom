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


/**
 * Агент, которым стал ученик/студент
 */
final class AgentEntity
{


	protected ?int $id;
	protected ?string $name;
	protected ?string $lastName;
	protected ?string $secondName;
	protected ?PasswordValueObject $password = null;
	protected ?PhoneValueObject $phone = null;
	protected ?EmailValueObject $email = null;
	protected ?InnValueObject $inn = null;
	protected ?KppValueObject $kpp = null;
	protected ?OgrnValueObject $ogrn = null;
	protected ?BikValueObject $bik = null;
	protected ?CurrAccountValueObject $currAcc = null;
	protected ?CorrAccountValueObject $corrAcc = null;
	protected ?string $postAddress = null;
	protected ?string $legalAddress = null;
	protected ?string $bankName = null;
	protected ?int $personalManagerId = null;

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
	): AgentEntity
	{

		$obj = new self();
		$obj->phone = $phone;
		$obj->email = $email;
		$obj->password = $password;
		$obj->inn = $inn;
		$obj->kpp = $kpp;
		$obj->ogrn = $ogrn;
		$obj->bik = $bik;
		$obj->currAcc = $currAcc;
		$obj->corrAcc = $corrAcc;
		$obj->postAddress = $postAddress;
		$obj->legalAddress = $legalAddress;
		$obj->bankName = $bankName;
		return $obj;

	}

	public static function fromFind(
		?int                    $id,
		?string                 $name,
		?string                 $lastName,
		?string                 $secondName,
		?PasswordValueObject    $password = null,
		?PhoneValueObject       $phone = null,
		?EmailValueObject       $email = null,
		?InnValueObject         $inn = null,
		?KppValueObject         $kpp = null,
		?OgrnValueObject        $ogrn = null,
		?BikValueObject         $bik = null,
		?CurrAccountValueObject $currAcc = null,
		?CorrAccountValueObject $corrAcc = null,
		?string                 $postAddress = null,
		?string                 $legalAddress = null,
		?string                 $bankName = null,
		?int                    $personalManagerId = null
	): AgentEntity
	{
		$obj = new self();

		$obj->id = $id;
		$obj->name = $name;
		$obj->lastName = $lastName;
		$obj->secondName = $secondName;
		$obj->password = $password;
		$obj->phone = $phone;
		$obj->email = $email;
		$obj->inn = $inn;
		$obj->kpp = $kpp;
		$obj->ogrn = $ogrn;
		$obj->bik = $bik;
		$obj->currAcc = $currAcc;
		$obj->corrAcc = $corrAcc;
		$obj->postAddress = $postAddress;
		$obj->legalAddress = $legalAddress;
		$obj->bankName = $bankName;
		$obj->personalManagerId = $personalManagerId;

		return $obj;
	}

	public static function simpleRegister(
		PhoneValueObject    $phone,
		EmailValueObject    $email,
		PasswordValueObject $password,
	): AgentEntity
	{
		return new AgentEntity(
			null,
			null,
			null,
			null,
			$password,
			$phone,
			$email,
		);
	}

	public function assignManager(ManagerEntity $manager): AgentEntity
	{
		$this->personalManagerId = $manager->getId();
		return $this;
	}

	public function refreshIdAfterRegister(int $id): AgentEntity
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