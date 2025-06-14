<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\Dto\BxImage;

class Developer
{
	public function __construct(
		public int      $id,
		public string   $name,
		public ?BxImage $picture = null
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

	public function getPicture(): BxImage
	{
		return $this->picture;
	}
}