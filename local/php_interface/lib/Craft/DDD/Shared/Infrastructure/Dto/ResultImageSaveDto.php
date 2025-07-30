<?php

namespace Craft\DDD\Shared\Infrastructure\Dto;

final class ResultImageSaveDto
{
	public function __construct(
		public int    $id,
		public string $src,
	)
	{
	}
}