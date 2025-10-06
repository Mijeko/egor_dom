<?php

namespace Craft\DDD\Claims\Present\Dto;

use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Developers\Present\Dto\ApartmentDto;

final class ClaimDto
{
	public function __construct(
		public int             $id,
		public ?StatusClaimDto $status,
		public string          $name,
		public string          $clientName,
		public string          $phone,
		public string          $email,
		public ApartmentDto    $apartment,
		public ?string         $createdAt = null,
	)
	{
	}

	public static function fromEntity(ClaimEntity $claim): ClaimDto
	{
		return new ClaimDto(
			$claim->getId(),
			StatusClaimDto::fromVO($claim->getStatus()),
			$claim->getName(),
			$claim->getClient(),
			$claim->getPhone()->getValue(),
			$claim->getEmail()->getValue(),
			ApartmentDto::fromEntity($claim->getApartmentEntity()),
			$claim->getCreatedAt(),
		);
	}
}