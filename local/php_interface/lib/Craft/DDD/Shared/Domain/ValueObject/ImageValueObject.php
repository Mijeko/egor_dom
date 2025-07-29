<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

final class ImageValueObject
{
	public function __construct(
		protected int    $id,
		protected string $src,
	)
	{
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getSrc(): string
	{
		return $this->src;
	}
}