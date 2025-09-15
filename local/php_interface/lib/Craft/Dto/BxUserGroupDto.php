<?php

namespace Craft\Dto;

class BxUserGroupDto
{
	public function __construct(
		public int    $id,
		public string $name,
		public string $code,
	)
	{
	}
}