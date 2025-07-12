<?php

namespace Craft\DDD\Claims\Present\Dto;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Developers\Present\Dto\ApartmentDto;

class ClaimDto
{
	public function __construct(
		public int             $id,
		public ?StatusClaimDto $status,
		public string          $name,
		public string          $clientName,
		public string          $phone,
		public string          $email,
		public string          $bik,
		public string          $ogrn,
		public string          $inn,
		public string          $kpp,
		public string          $legalAddress,
		public string          $postAddress,
		public string          $currAcc,
		public string          $corrAcc,
		public ApartmentDto    $apartment,
		public string          $createdAt,
	)
	{
	}

	public static function fromEntity(ClaimEntity $claim): static
	{
		return new static(
			$claim->getId(),
			StatusClaimDto::fromVO($claim->getStatus()),
			$claim->getName(),
			$claim->getClient(),
			$claim->getPhone(),
			$claim->getEmail(),
			$claim->getBik()->getValue(),
			$claim->getOgrn()->getValue(),
			$claim->getInn()->getValue(),
			$claim->getKpp()->getValue(),
			$claim->getLegalAddress(),
			$claim->getPostAddress(),
			$claim->getCurrAcc()->getValue(),
			$claim->getCorrAcc()->getValue(),
			ApartmentDto::fromEntity($claim->getApartmentEntity()),
			$claim->getCreatedAt(),
		);
	}
}