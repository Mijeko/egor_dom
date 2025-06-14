<?php

namespace Craft\DDD\Objects\Infrastructure\Dto;

use Craft\Dto\BxImage;

class BuildObjectFrontDto
{

	public ?string $detailLink;

	public function __construct(
		public int      $id,
		public string   $name,
		public ?BxImage $picture = null,
	)
	{

		$this->detailLink = '/objects/' . $this->id . '/';
	}
}