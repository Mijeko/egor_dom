<?php

namespace Craft\Dto;

class ProfileEditUserDataDto
{
	public function __construct(
		public ?string $name,
		public ?string $family,
		public ?string $last_name,
		public ?string $uf_corr_acc,
		public ?string $uf_inn,
	)
	{
	}
}