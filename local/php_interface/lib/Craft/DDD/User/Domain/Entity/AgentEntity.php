<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\Claims\Domain\ValueObject\BikValueObject;
use Craft\DDD\Claims\Domain\ValueObject\CorrAccountValueObject;
use Craft\DDD\Claims\Domain\ValueObject\CurrAccountValueObject;
use Craft\DDD\Claims\Domain\ValueObject\InnValueObject;
use Craft\DDD\Claims\Domain\ValueObject\KppValueObject;
use Craft\DDD\Claims\Domain\ValueObject\OgrnValueObject;

class AgentEntity
{

	public function __construct(
		protected ?int   $id,
		protected string $phone,
		protected string $password,
		protected string $inn,
		protected string $kpp,
		protected string $ogrn,
		protected string $bik,
		protected string $currAcc,
		protected string $corrAcc,
		protected string $postAddress,
		protected string $legalAddress,
		protected string $bankName,
	)
	{
	}

	public static function register(
		string                 $phone,
		string                 $password,
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
			$phone,
			$password,
			$inn->getValue(),
			$kpp->getValue(),
			$ogrn->getValue(),
			$bik->getValue(),
			$currAcc->getValue(),
			$corrAcc->getValue(),
			$postAddress,
			$legalAddress,
			$bankName,
		);
	}

	public function refreshIdAfterRegister(int $id): static
	{
		$this->id = $id;
		return $this;
	}
}