<?php

namespace Craft\DDD\Objects\Infrastructure\Dto;

class BuildObjectFrontDto
{

	public ?string $detailLink;

	public function __construct(
		public int    $id,
		public string $name,
		public ?array $picture = null,
	)
	{

		$this->detailLink = '/objects/' . $this->id . '/';
	}
}