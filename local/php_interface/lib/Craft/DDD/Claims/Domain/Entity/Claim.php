<?php

namespace Craft\DDD\Claims\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\BikValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\KppValueObject;
use Craft\DDD\Shared\Domain\ValueObject\OgrnValueObject;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\User\Domain\Entity\UserEntity;

class Claim
{

	public function __construct(
		protected ?int                    $id,
		protected ?string                 $name,
		protected ?string                 $email,
		protected ?string                 $phone,
		protected ?string                                                $client,
		protected ?InnValueObject                                        $inn,
		protected ?KppValueObject                                        $kpp,
		protected ?BikValueObject                                        $bik,
		protected ?OgrnValueObject                                       $ogrn,
		protected ?CurrAccountValueObject                                $currAcc,
		protected ?CorrAccountValueObject                                $corrAcc,
		protected ?string                                                $legalAddress,
		protected ?string                                                $postAddress,
		protected ?string                                                $bankName,
		protected ?\Craft\DDD\Developers\Domain\Entity\BuildObjectEntity $buildObject,
		protected ?UserEntity                                            $user,
	)
	{
	}

	public static function createClaim(
		string      $name,
		string      $email,
		string      $phone,
		string            $client,
		int               $inn,
		int               $kpp,
		int               $bik,
		int               $ogrn,
		string            $currAcc,
		string            $corrAcc,
		string            $legalAddress,
		string            $postAddress,
		string            $bankName,
		BuildObjectEntity $buildObject,
		UserEntity        $user,
	): static
	{
		return new static(
			null,
			$name,
			$email,
			$phone,
			$client,
			new InnValueObject($inn),
			new KppValueObject($kpp),
			new BikValueObject($bik),
			new OgrnValueObject($ogrn),
			new CurrAccountValueObject($currAcc),
			new CorrAccountValueObject($corrAcc),
			$legalAddress,
			$postAddress,
			$bankName,
			$buildObject,
			$user
		);
	}

	public function refreshIdAfterCreate(int $id): static
	{
		$this->id = $id;
		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getBuildObject(): \Craft\DDD\Developers\Domain\Entity\BuildObjectEntity
	{
		return $this->buildObject;
	}

	public function getUser(): ?UserEntity
	{
		return $this->user;
	}

	public function getPhone(): ?string
	{
		return $this->phone;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function getClient(): ?string
	{
		return $this->client;
	}

	public function getBankName(): ?string
	{
		return $this->bankName;
	}

	public function getOgrn(): ?OgrnValueObject
	{
		return $this->ogrn;
	}

	public function getKpp(): ?KppValueObject
	{
		return $this->kpp;
	}

	public function getInn(): ?InnValueObject
	{
		return $this->inn;
	}

	public function getCurrAcc(): ?CurrAccountValueObject
	{
		return $this->currAcc;
	}

	public function getCorrAcc(): ?CorrAccountValueObject
	{
		return $this->corrAcc;
	}

	public function getBik(): ?BikValueObject
	{
		return $this->bik;
	}

	public function getPostAddress(): ?string
	{
		return $this->postAddress;
	}

	public function getLegalAddress(): ?string
	{
		return $this->legalAddress;
	}
}