<?php

namespace Craft\Dto;

class BxUserGroupDto
{
	public function __construct(
		public int $id,
		public int $name,
		public int $code,
	)
	{
	}
}