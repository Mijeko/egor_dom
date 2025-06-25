<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\Dto\BxImageDto;

class Developer
{
	public function __construct(
		public int      $id,
		public string   $name,
		public ?BxImageDto $picture = null
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

	public function getPicture(): BxImageDto
	{
		return $this->picture;
	}
}