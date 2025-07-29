<?php

namespace Craft\DDD\Shared\Infrastructure\Dto;

class ResultImageSaveDto
{
	public function __construct(
		public int    $id,
		public string $src,
	)
	{
	}
}