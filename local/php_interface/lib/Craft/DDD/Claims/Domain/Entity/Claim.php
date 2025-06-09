<?php

namespace Craft\DDD\Claims\Domain\Entity;

use Craft\DDD\Objects\Domain\BuildObject;

class Claim
{
	public function __construct(
		public int         $id,
		public string      $name,
		public BuildObject $buildObject,
	)
	{
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getBuildObject(): BuildObject
	{
		return $this->buildObject;
	}
}