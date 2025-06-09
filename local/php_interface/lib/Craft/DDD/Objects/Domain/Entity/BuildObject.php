<?php

namespace Craft\DDD\Objects\Domain\Entity;

class BuildObject
{
	public function __construct(
		public int    $id,
		public string $name,
		public ?int   $pictureId = null,
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

	public function getPictureId(): ?int
	{
		return $this->pictureId;
	}
}