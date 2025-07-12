<?php

namespace Craft\DDD\Claims\Present\Dto;

use Craft\DDD\Claims\Domain\ValueObject\StatusValueObject;

class StatusClaimDto
{
	public function __construct(
		public ?string $code,
		public ?string $label,
		public ?string $icon,
	)
	{
	}

	public static function fromVO(StatusValueObject $status): static
	{
		return new static(
			$status->getCode(),
			$status->getLabel(),
			$status->getIcon()
		);
	}
}