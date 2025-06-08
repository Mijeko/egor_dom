<?php

namespace Craft\DDD\Claims\Domain\Entity;

class Claim
{
	public function __construct(
		protected int    $id,
		protected string $name,
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
}