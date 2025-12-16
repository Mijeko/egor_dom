<?php

namespace Craft\DDD\User\Application\Dto;

use Craft\Dto\BxImageDto;

class CurrentUserDto
{
	public function __construct(
		public int         $id,
		public string      $name,
		public string      $email,
		public ?BxImageDto $avatar = null,
	)
	{
	}
}