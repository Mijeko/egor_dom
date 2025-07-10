<?php

namespace Craft\Dto;

class ProfileEditUserDataDto
{
	public function __construct(
		public ?string $profileType,
		public ?string $id,
		public ?string $name,
		public ?string $family,
		public ?string $last_name,
		public ?string $uf_bank_name,
		public ?string $uf_corr_acc,
		public ?string $uf_curr_acc,
		public ?string $uf_inn,
		public ?string $uf_bik,
		public ?string $uf_ogrn,
		public ?string $uf_kpp,
		public ?string $uf_post_address,
		public ?string $uf_legal_address,
	)
	{
	}
}