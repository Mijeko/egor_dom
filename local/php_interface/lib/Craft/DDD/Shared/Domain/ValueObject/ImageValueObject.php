<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Craft\DDD\Shared\Infrastructure\Dto\ResultImageSaveDto;

class ImageValueObject
{
	public function __construct(
		protected int    $id,
		protected string $src,
	)
	{
	}

	public static function fromImageResult(ResultImageSaveDto $imageSaveDto): ?static
	{
		return new static(
			$imageSaveDto->id,
			$imageSaveDto->src
		);
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