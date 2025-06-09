<?php

namespace Craft\DDD\Developers\Domain\Entity;

class Developer
{
	public function __construct(
		public int    $id,
		public string $name,
		public int    $pictureId
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

	public function getPictureId(): int
	{
		return $this->pictureId;
	}
}