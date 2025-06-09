<?php

namespace Craft\DDD\Objects\Infrastructure\Dto;

class BuildObjectDetailDto
{
	public function __construct(
		public string $id,
		public string $name,
	)
	{
	}
}