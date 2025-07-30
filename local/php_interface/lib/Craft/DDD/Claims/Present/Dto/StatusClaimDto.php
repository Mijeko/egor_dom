<?php

namespace Craft\DDD\Claims\Present\Dto;

use Craft\DDD\Claims\Domain\ValueObject\StatusValueObject;

final class StatusClaimDto
{
	public function __construct(
		public ?string $code,
		public ?string $label,
		public ?string $icon,
		public ?string $color,
	)
	{
	}

	public static function fromVO(StatusValueObject $status): StatusClaimDto
	{
		return new StatusClaimDto(
			$status->getCode(),
			$status->getLabel(),
			$status->getIcon(),
			$status->getColor(),
		);
	}
}