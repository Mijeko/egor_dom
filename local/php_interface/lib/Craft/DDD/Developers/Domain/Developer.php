<?php

namespace Craft\DDD\Developers\Domain;

class Developer
{
	public function __construct(
		public int    $id,
		public string $name,
	)
	{

	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}
}