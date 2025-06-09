<?php

namespace Craft\DDD\Objects\Domain\Entity;

class BuildObject
{
	public function __construct(
		public int    $id,
		public string $name,
	)
	{
	}
}