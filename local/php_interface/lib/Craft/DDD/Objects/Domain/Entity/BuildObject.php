<?php

namespace Craft\DDD\Objects\Domain\Entity;

use Craft\Dto\BxImage;

class BuildObject
{
	public function __construct(
		public int      $id,
		public string   $name,
		public ?BxImage $picture = null,
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

	public function getPicture(): ?BxImage
	{
		return $this->picture;
	}
}