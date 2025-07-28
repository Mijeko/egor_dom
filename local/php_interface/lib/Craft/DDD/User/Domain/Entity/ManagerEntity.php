<?php

namespace Craft\DDD\User\Domain\Entity;

class ManagerEntity
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