<?php

namespace Craft\Dto;

use Craft\Model\CraftUser;

class BxUserDto
{


	public function __construct(
		public int    $id,
		public string $name,
	)
	{
	}

	public static function fromGlobal(): ?static
	{

		$user = CraftUser::load();
		if(!$user->IsAuthorized())
		{
			return null;
		}

		return new static(
			$user->getId(),
			$user->getName(),
		);
	}
}